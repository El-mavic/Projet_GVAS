<?php
require 'config.php';
require 'upload_helpers.php';
if (empty($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
$id = (int)$_SESSION['user_id'];
$stmt = $pdo->prepare('SELECT * FROM users WHERE id = ?');
$stmt->execute([$id]);
$u = $stmt->fetch();
if (!$u) {
    session_destroy();
    header('Location: login.php');
    exit;
}
$erreur = '';
$ok = '';

// Ensure the projects table exists; database migration is also provided in migration_projets.sql.
try {
    $pdo->query('SELECT id FROM projets LIMIT 1');
} catch (PDOException $e) {
    $erreur = 'La table des projets manque dans la base. Exécutez le fichier migration_projets.sql fourni avec le projet.';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!hash_equals($_SESSION['csrf'] ?? '', $_POST['csrf'] ?? '')) {
        $erreur = 'Session expirée, rechargez la page.';
    } else {
        $action = $_POST['action'] ?? 'save_profile';
        try {
            if ($action === 'delete_account') {
                $passwordConfirmation = (string)($_POST['confirm_password'] ?? '');
                if (!password_verify($passwordConfirmation, (string)($u['password_hash'] ?? ''))) {
                    throw new RuntimeException('Le mot de passe est incorrect. Votre compte n’a pas été supprimé.');
                }

                // Rassembler les fichiers du profil et des projets avant suppression.
                $filesToDelete = [];
                foreach (['photo', 'cover_photo', 'cv_path'] as $field) {
                    if (!empty($u[$field])) $filesToDelete[] = $u[$field];
                }
                $projectStmt = $pdo->prepare('SELECT image FROM projets WHERE user_id = ?');
                $projectStmt->execute([$id]);
                foreach ($projectStmt->fetchAll(PDO::FETCH_COLUMN) as $projectImage) {
                    if (!empty($projectImage)) $filesToDelete[] = $projectImage;
                }

                $pdo->beginTransaction();
                try {
                    $pdo->prepare('DELETE FROM projets WHERE user_id = ?')->execute([$id]);
                    $deleteUser = $pdo->prepare('DELETE FROM users WHERE id = ?');
                    $deleteUser->execute([$id]);
                    if ($deleteUser->rowCount() !== 1) {
                        throw new RuntimeException('Le compte est introuvable ou a déjà été supprimé.');
                    }
                    $pdo->commit();
                } catch (Throwable $deleteError) {
                    if ($pdo->inTransaction()) $pdo->rollBack();
                    throw $deleteError;
                }

                // Supprimer uniquement les fichiers présents dans le dossier uploads du projet.
                $uploadsRoot = realpath(__DIR__ . '/uploads');
                if ($uploadsRoot !== false) {
                    foreach (array_unique($filesToDelete) as $relativePath) {
                        $relativePath = ltrim(str_replace('\\', '/', (string)$relativePath), '/');
                        $candidate = realpath(__DIR__ . '/' . $relativePath);
                        if (
                            $candidate !== false && is_file($candidate)
                            && strpos($candidate, $uploadsRoot . DIRECTORY_SEPARATOR) === 0
                        ) {
                            @unlink($candidate);
                        }
                    }
                }

                // Fermer la session de l'utilisateur après suppression définitive.
                $_SESSION = [];
                if (ini_get('session.use_cookies')) {
                    $cookie = session_get_cookie_params();
                    setcookie(session_name(), '', time() - 42000, $cookie['path'], $cookie['domain'], $cookie['secure'], $cookie['httponly']);
                }
                session_destroy();
                header('Location: index.php?compte=supprime');
                exit;
            } elseif ($action === 'add_project') {
                $titre = trim($_POST['titre'] ?? '');
                $description = trim($_POST['description'] ?? '');
                $lien = trim($_POST['lien'] ?? '');
                if (mb_strlen($titre) < 2) throw new RuntimeException('Le titre du projet doit contenir au moins 2 caractères.');
                if ($lien !== '' && !filter_var($lien, FILTER_VALIDATE_URL)) throw new RuntimeException('Le lien du projet doit être une URL complète commençant par https://.');
                $image = portfolioUpload('project_image', 'image');
                $stmt = $pdo->prepare('INSERT INTO projets (user_id, titre, description, image, lien) VALUES (?, ?, ?, ?, ?)');
                $stmt->execute([$id, $titre, $description, $image, $lien !== '' ? $lien : null]);
                $ok = 'Votre réalisation a été publiée sur votre portfolio.';
            } elseif ($action === 'delete_project') {
                $projectId = filter_input(INPUT_POST, 'project_id', FILTER_VALIDATE_INT);
                if (!$projectId) throw new RuntimeException('Projet invalide.');
                $stmt = $pdo->prepare('SELECT image FROM projets WHERE id = ? AND user_id = ?');
                $stmt->execute([$projectId, $id]);
                $project = $stmt->fetch();
                if (!$project) throw new RuntimeException('Ce projet est introuvable.');
                $stmt = $pdo->prepare('DELETE FROM projets WHERE id = ? AND user_id = ?');
                $stmt->execute([$projectId, $id]);
                if (!empty($project['image'])) {
                    $path = __DIR__ . '/' . ltrim($project['image'], '/');
                    if (is_file($path) && strpos(realpath($path), realpath(__DIR__ . '/uploads')) === 0) @unlink($path);
                }
                $ok = 'Le projet a été supprimé.';
            } else {
                $nom = trim($_POST['nom'] ?? '');
                $email = filter_var(trim($_POST['email'] ?? ''), FILTER_VALIDATE_EMAIL);
                if (mb_strlen($nom) < 2 || !$email) throw new RuntimeException('Le nom et une adresse e-mail valide sont obligatoires.');
                $photo = portfolioUpload('photo', 'image', $u['photo'] ?? null);
                $cover = portfolioUpload('cover_photo', 'image', $u['cover_photo'] ?? null);
                $cv = portfolioUpload('cv', 'cv', $u['cv_path'] ?? null);
                $requestedPublic = isset($_POST['public']) ? 1 : 0;
                // Aucune case du formulaire ne peut publier un portfolio non payé.
                $public = (($u['payment_status'] ?? 'unpaid') === 'paid') ? $requestedPublic : 0;
                $sql = 'UPDATE users SET nom=?, email=?, metier=?, bio=?, competences=?, telephone=?, localisation=?, formation=?, experience=?, certifications=?, langues=?, centre_interet=?, site_web=?, linkedin=?, photo=?, cover_photo=?, cv_path=?, public=? WHERE id=?';
                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    $nom,
                    $email,
                    trim($_POST['metier'] ?? ''),
                    trim($_POST['bio'] ?? ''),
                    trim($_POST['competences'] ?? ''),
                    trim($_POST['telephone'] ?? ''),
                    trim($_POST['localisation'] ?? ''),
                    trim($_POST['formation'] ?? ''),
                    trim($_POST['experience'] ?? ''),
                    trim($_POST['certifications'] ?? ''),
                    trim($_POST['langues'] ?? ''),
                    trim($_POST['centre_interet'] ?? ''),
                    trim($_POST['site_web'] ?? ''),
                    trim($_POST['linkedin'] ?? ''),
                    $photo,
                    $cover,
                    $cv,
                    $public,
                    $id
                ]);
                $ok = 'Votre portfolio a été mis à jour.';
            }
            $stmt = $pdo->prepare('SELECT * FROM users WHERE id=?');
            $stmt->execute([$id]);
            $u = $stmt->fetch();
        } catch (RuntimeException $ex) {
            $erreur = $ex->getMessage();
        } catch (PDOException $ex) {
            $erreur = $ex->getCode() === '23000' ? 'Cette adresse e-mail est déjà utilisée.' : 'Enregistrement impossible. Vérifiez la structure de la base de données et la migration des projets.';
        }
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SERVER['HTTP_X_AUTOSAVE'])) {
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode([
        'success' => $erreur === '',
        'message' => $erreur !== '' ? $erreur : ($ok !== '' ? $ok : 'Informations enregistrées.')
    ], JSON_UNESCAPED_UNICODE);
    exit;
}
$projects = [];
try {
    $stmt = $pdo->prepare('SELECT id, titre, description, image, lien, created_at FROM projets WHERE user_id = ? ORDER BY created_at DESC');
    $stmt->execute([$id]);
    $projects = $stmt->fetchAll();
} catch (PDOException $e) { /* displayed above if table missing */
}
$_SESSION['csrf'] = bin2hex(random_bytes(32));
$pageTitle = 'Mon espace';
require 'includes/header.php';
?>
<?php
// Le texte initial évite un affichage vide avant le réglage JavaScript avec l'heure du navigateur.
$dashboardGreeting = 'Bonjour';
?>
    <h1 class="section-kicker" style="font-size: 25px; margin: 3px;">VOTRE ESPACE PERSONNEL</h1>

<section class="dashboard-intro">
    <h1><span class="dashboard-greeting"><?= e($dashboardGreeting) ?></span> <?= e($u['nom']) ?> <span> !</span> </h1>

    <p>Complétez votre profil, ajoutez votre CV et présentez vos réalisations.</p>

    <?php if (($u['payment_status'] ?? 'unpaid') === 'paid'): ?>
        <a class="profile-link dashboard-view" href="profil.php?id=<?= $id ?>">
            Voir mon portfolio public
        </a>
    <?php endif; ?>

</section>

<?php if ($erreur): ?><div class="alert dashboard-alert"><?= e($erreur) ?></div><?php endif; ?><?php if ($ok): ?><div class="success dashboard-alert"><?= e($ok) ?></div><?php endif; ?>
<dialog class="dashboard-modal payment-modal" id="paiement" aria-labelledby="payment-modal-title">
    <div class="dashboard-modal-content">
        <button class="dashboard-modal-close" type="button" data-close-dashboard-modal aria-label="Fermer">&times;</button>
        <?php if (($u['payment_status'] ?? 'unpaid') !== 'paid'): ?>
            <span class="section-kicker">ÉTAPE AVANT PUBLICATION</span>
            <h2 id="payment-modal-title">Votre portfolio n’est pas encore public</h2>
            <p>
                Enregistrez vos informations, puis payez les frais de publication.
                Votre profil sera visible sur l’accueil après confirmation du paiement par Yabetoo Pay.
            </p>
            <a class="button-primary btn-paiement" href="paiement.php">
                <i class="fa-solid fa-paper-plane"></i>
                <span>Publier mon portfolio</span>
            </a>
            <p class="muted payment-status">État du paiement : non payé</p>
        <?php else: ?>
            <span class="section-kicker">PAIEMENT</span>
            <h2 id="payment-modal-title">Paiement confirmé</h2>
            <div class="success dashboard-alert">
                Votre paiement est confirmé. Vous pouvez gérer la visibilité de votre portfolio depuis le formulaire ci-dessous.
            </div>
        <?php endif; ?>
    </div>
</dialog>

<div class="profile-editor-layout">

    <section class="auth-card editor-card profile-editor-form">

        <button class="portfolio-editor-toggle" type="button" data-profile-editor-toggle aria-expanded="false" aria-controls="portfolio-profile-editor-body">
            <span class="portfolio-editor-toggle-icon"><i class="fa-solid fa-user-pen"></i></span>
            <span class="portfolio-editor-toggle-copy">
                <strong>Compléter mon portfolio</strong>
                <small>Identité, formation, compétences et projets · 3 étapes</small>
            </span>
            <span class="portfolio-editor-toggle-chevron" aria-hidden="true"><i class="fa-solid fa-chevron-down"></i></span>
        </button>

        <div class="portfolio-profile-editor-body" id="portfolio-profile-editor-body" hidden>
            <p class="portfolio-editor-intro">Complétez vos informations et suivez leur aperçu en direct.</p>

            <form method="post" enctype="multipart/form-data" class="stack-form portfolio-carousel-form" id="portfolio-profile-form">

            <input type="hidden" name="csrf" value="<?= e($_SESSION['csrf']) ?>">
            <input type="hidden" name="action" value="save_profile">

            <div class="portfolio-carousel-progress" aria-label="Étapes du formulaire">
                <div class="carousel-step is-active" data-carousel-step="0" aria-current="step">
                    <span>1</span> Identité
                </div>
                <div class="carousel-step" data-carousel-step="1">
                    <span>2</span> Formation & compétences
                </div>
                <div class="carousel-step" data-carousel-step="2">
                    <span>3</span> Projets
                </div>
            </div>

            <div class="portfolio-carousel-slides">
                <section class="portfolio-carousel-slide is-active" data-carousel-slide="0">
                    <div class="carousel-slide-heading">
                        <span class="carousel-slide-icon"><i class="fa-solid fa-user"></i></span>
                        <div>
                            <span class="section-kicker">ÉTAPE 1</span>
                            <h3>Identité</h3>
                            <p>Présentez votre identité professionnelle.</p>
                        </div>
                    </div>

                    <label>Nom complet
                        <input name="nom" required minlength="2" value="<?= e($u['nom']) ?>">
                    </label>
                    <label>E-mail *
                        <input type="email" name="email" required value="<?= e($u['email']) ?>">
                    </label>
                    <label>Métier ou spécialité
                        <input name="metier" placeholder="Ex. Développeur web" value="<?= e($u['metier'] ?? '') ?>">
                    </label>
                    <label>Présentation personnelle
                        <textarea name="bio" rows="5" placeholder="Présentez votre parcours..."><?= e($u['bio'] ?? '') ?></textarea>
                    </label>
                    <div class="form-two">
                        <label>Téléphone
                            <span class="phone-input-group">
                                <select name="indicatif_telephone" class="phone-country-code" aria-label="Indicatif téléphonique">
                                    <option value="+242">🇨🇬 +242</option>
                                    <option value="+33">🇫🇷 +33</option>
                                    <option value="+237">🇨🇲 +237</option>
                                    <option value="+32">🇧🇪 +32</option>
                                    <option value="+221">🇸🇳 +221</option>
                                    <option value="+225">🇨🇮 +225</option>
                                    <option value="+1">🇨🇦 +1</option>
                                    <option value="+1">🇺🇸 +1</option>
                                    <option value="other">Autre indicatif</option>
                                </select>
                                <input type="tel" name="indicatif_personnalise" class="phone-custom-code" inputmode="tel" autocomplete="tel-country-code" placeholder="Ex. +44" aria-label="Indicatif personnalisé" hidden>
                                <input type="tel" name="telephone_local" inputmode="tel" autocomplete="tel-national" placeholder="06 420 14 15" value="">
                                <input type="hidden" name="telephone" value="<?= e($u['telephone'] ?? '') ?>">
                            </span>
                        </label>
                        <label>Ville / pays
                            <input name="localisation" list="suggestions-localisation" autocomplete="address-level2" placeholder="Choisir ou saisir une ville, un pays" value="<?= e($u['localisation'] ?? '') ?>">
                            <datalist id="suggestions-localisation">
                                <option value="Brazzaville, République du Congo"></option>
                                <option value="Pointe-Noire, République du Congo"></option>
                                <option value="Dolisie, République du Congo"></option>
                                <option value="Nkayi, République du Congo"></option>
                                <option value="Ouésso, République du Congo"></option>
                                <option value="Mouyondzi, République du Congo"></option>
                                <option value="Impfondo, République du Congo"></option>
                                <option value="Kinshasa, République démocratique du Congo"></option>
                                <option value="Lubumbashi, République démocratique du Congo"></option>
                                <option value="Goma, République démocratique du Congo"></option>
                                <option value="Libreville, Gabon"></option>
                                <option value="Douala, Cameroun"></option>
                                <option value="Yaoundé, Cameroun"></option>
                                <option value="Abidjan, Côte d'Ivoire"></option>
                                <option value="Paris, France"></option>
                            </datalist>
                        </label>
                    </div>

                    <h4 class="form-section-title">Photo de profil, couverture et CV</h4>
                    <div class="portfolio-media-upload-grid">
                    <?php if (!empty($u['photo'])): ?>
                        <div class="upload-preview">
                            <img src="<?= e($u['photo']) ?>" alt="Photo de profil actuelle">
                            <span>Photo de profil actuelle</span>
                        </div>
                    <?php endif; ?>
                    <label>Photo de profil <span class="muted">(JPG, PNG, WEBP · 3 Mo max.)</span>
                        <input type="file" name="photo" accept="image/jpeg,image/png,image/webp">
                        <small>Laissez vide pour conserver la photo actuelle.</small>
                    </label>
                    <?php if (!empty($u['cover_photo'])): ?>
                        <div class="cover-preview" style="background-image: url('<?= e(str_replace(["'", '\\'], ['%27', '%5C'], $u['cover_photo'])) ?>')">
                            <span>Couverture actuelle</span>
                        </div>
                    <?php endif; ?>
                    <label>Photo de couverture <span class="muted">(JPG, PNG, WEBP · 3 Mo max.)</span>
                        <input type="file" name="cover_photo" accept="image/jpeg,image/png,image/webp">
                        <small>Laissez vide pour conserver la couverture actuelle.</small>
                    </label>
                    <?php if (!empty($u['cv_path'])): ?>
                        <p class="current-file">CV actuel :
                            <a href="cv.php?id=<?= (int) $id ?>" target="_blank" rel="noopener noreferrer">Consulter le CV ↗</a>
                        </p>
                    <?php endif; ?>
                    <label>CV <span class="muted">(PDF, DOC, DOCX · 5 Mo max.)</span>
                        <input type="file" name="cv" accept=".pdf,.doc,.docx">
                        <small>Laissez vide pour conserver le CV actuel.</small>
                    </label>
                    </div>

                    <h4 class="form-section-title">Liens professionnels</h4>
                    <div class="profile-links-grid">
                        <label><i class="fa-solid fa-globe"></i> Site web
                            <input type="url" name="site_web" placeholder="https://..." value="<?= e($u['site_web'] ?? '') ?>">
                        </label>
                        <label><i class="fab fa-linkedin"></i> LinkedIn
                            <input type="url" name="linkedin" placeholder="https://linkedin.com/in/..." value="<?= e($u['linkedin'] ?? '') ?>">
                        </label>
                        <label><i class="fab fa-github"></i> GitHub <span class="muted">(optionnel)</span>
                            <input type="url" name="github" placeholder="https://github.com/votre-profil">
                        </label>
                    </div>
                    <div class="profile-repeater profile-professional-links" data-profile-repeater="liens_professionnels" data-input-type="url" data-placeholder="https://autre-profil-professionnel.com">
                        <div class="profile-repeater-heading">
                            <div><strong>Autres liens professionnels</strong><span>Ajoutez autant de liens utiles que nécessaire.</span></div>
                            <button type="button" class="profile-repeat-add" data-add-profile-item aria-label="Ajouter un lien professionnel"><i class="fa-solid fa-plus"></i></button>
                        </div>
                        <div class="profile-repeat-items"></div>
                        <input type="hidden" name="liens_professionnels" value="">
                    </div>
                    <?php if (($u['payment_status'] ?? 'unpaid') === 'paid'): ?>
                        <label class="checkbox-label">
                            <input type="checkbox" name="public" value="1" <?= !empty($u['public']) ? 'checked' : '' ?>>
                            Mon portfolio est visible dans les recherches
                        </label>
                    <?php else: ?>
                        <p class="muted">La visibilité publique sera activée après confirmation du paiement.</p>
                    <?php endif; ?>
                </section>

                <section class="portfolio-carousel-slide" data-carousel-slide="1">
                    <div class="carousel-slide-heading">
                        <span class="carousel-slide-icon"><i class="fa-solid fa-graduation-cap"></i></span>
                        <div>
                            <span class="section-kicker">ÉTAPE 2</span>
                            <h3>Formation & compétences</h3>
                            <p>Présentez vos connaissances et votre parcours.</p>
                        </div>
                    </div>

                    <div class="profile-repeater" data-profile-repeater="competences" data-placeholder="Ex. PHP, gestion de projet, design graphique">
                        <div class="profile-repeater-heading">
                            <div><strong>Compétences</strong><span>Ajoutez chaque compétence séparément.</span></div>
                            <button type="button" class="profile-repeat-add" data-add-profile-item aria-label="Ajouter une compétence"><i class="fa-solid fa-plus"></i></button>
                        </div>
                        <div class="profile-repeat-items"></div>
                        <input type="hidden" name="competences" value="<?= e($u['competences'] ?? '') ?>">
                    </div>
                    <div class="profile-repeaters">
                        <div class="profile-repeater" data-profile-repeater="formation" data-placeholder="Ex. Licence en informatique — Université de Pointe-Noire">
                            <div class="profile-repeater-heading">
                                <div><strong>Formation et études</strong><span>Ajoutez chaque diplôme ou formation séparément.</span></div>
                                <button type="button" class="profile-repeat-add" data-add-profile-item aria-label="Ajouter une formation"><i class="fa-solid fa-plus"></i></button>
                            </div>
                            <div class="profile-repeat-items"></div>
                            <input type="hidden" name="formation" value="<?= e($u['formation'] ?? '') ?>">
                        </div>
                        <div class="profile-repeater" data-profile-repeater="experience" data-placeholder="Ex. Développeur web — Entreprise BHS — 2024 à aujourd’hui">
                            <div class="profile-repeater-heading">
                                <div><strong>Expérience professionnelle</strong><span>Ajoutez chaque mission ou expérience séparément.</span></div>
                                <button type="button" class="profile-repeat-add" data-add-profile-item aria-label="Ajouter une expérience"><i class="fa-solid fa-plus"></i></button>
                            </div>
                            <div class="profile-repeat-items"></div>
                            <input type="hidden" name="experience" value="<?= e($u['experience'] ?? '') ?>">
                        </div>
                        <div class="profile-repeater" data-profile-repeater="certifications" data-placeholder="Légende du diplôme ou certificat — Ex. Certification développeur web — 2024">
                            <div class="profile-repeater-heading">
                                <div><strong>Certifications et distinctions</strong><span>Ajoutez chaque certificat, prix ou distinction séparément.</span></div>
                                <button type="button" class="profile-repeat-add" data-add-profile-item aria-label="Ajouter une certification"><i class="fa-solid fa-plus"></i></button>
                            </div>
                            <div class="profile-repeat-items"></div>
                            <input type="hidden" name="certifications" value="<?= e($u['certifications'] ?? '') ?>">
                        </div>
                    </div>
                    <div class="profile-repeaters profile-repeaters-options">
                        <div class="profile-repeater" data-profile-repeater="langues" data-placeholder="Choisissez ou saisissez une langue">
                            <div class="profile-repeater-heading">
                                <div><strong>Langues</strong><span>Ajoutez chaque langue séparément.</span></div>
                                <button type="button" class="profile-repeat-add" data-add-profile-item aria-label="Ajouter une langue"><i class="fa-solid fa-plus"></i></button>
                            </div>
                            <div class="profile-repeat-items" data-repeat-suggestions="Français, Anglais, Espagnol, Allemand, Portugais, Italien, Arabe, Lingala, Chinois"></div>
                            <input type="hidden" name="langues" value="<?= e($u['langues'] ?? '') ?>">
                        </div>
                        <div class="profile-repeater" data-profile-repeater="centre_interet" data-placeholder="Choisissez ou saisissez un centre d’intérêt">
                            <div class="profile-repeater-heading">
                                <div><strong>Centres d’intérêt</strong><span>Ajoutez chaque loisir séparément.</span></div>
                                <button type="button" class="profile-repeat-add" data-add-profile-item aria-label="Ajouter un centre d’intérêt"><i class="fa-solid fa-plus"></i></button>
                            </div>
                            <div class="profile-repeat-items" data-repeat-suggestions="Lecture, Musique, Sport, Voyages, Photographie, Programmation, Cuisine, Art et dessin, Jeux vidéo"></div>
                            <input type="hidden" name="centre_interet" value="<?= e($u['centre_interet'] ?? '') ?>">
                        </div>
                    </div>
                    <div class="autosave-status" data-autosave-status role="status" aria-live="polite">
                        Les modifications sont enregistrées automatiquement.
                    </div>
                </section>
            </div>

            <div class="portfolio-carousel-actions">
                <button class="button-secondary carousel-prev" type="button" data-carousel-prev disabled>
                    Précédent
                </button>
                <button class="button-primary carousel-next" type="button" data-carousel-next>
                    Suivant
                </button>
            </div>
            </form>
        </div>

    </section>


    <aside class="portfolio-live-preview" aria-live="polite">

        <div class="live-preview-heading">
            <span class="section-kicker">APERÇU EN DIRECT</span>
            <span class="live-indicator"><i></i> Mise à jour instantanée</span>
        </div>

        <article class="live-profile-card">

            <div class="live-cover" id="preview-cover"
                style="<?= !empty($u['cover_photo']) ? "background-image: url('" . e($u['cover_photo']) . "')" : '' ?>">
                <span>Votre portfolio</span>
            </div>

            <div class="live-avatar-wrap">
                <img
                    id="preview-photo"
                    src="<?= e($u['photo'] ?? '') ?>"
                    alt="Aperçu de la photo de profil"
                    <?= empty($u['photo']) ? 'hidden' : '' ?>>

                <span id="preview-initial" <?= !empty($u['photo']) ? 'hidden' : '' ?>>
                    <?= e(mb_strtoupper(mb_substr($u['nom'] ?? 'P', 0, 1))) ?>
                </span>
            </div>

            <div class="live-profile-content">

                <h3 id="preview-name">
                    <?= e($u['nom'] ?: 'Votre nom complet') ?>
                </h3>

                <p class="live-job" id="preview-job">
                    <?= e($u['metier'] ?: 'Votre métier ou spécialité') ?>
                </p>

                <p class="live-location" id="preview-location">
                    <?= e($u['localisation'] ?: 'Votre ville / pays') ?>
                </p>

                <p class="live-bio" id="preview-bio">
                    <?= e($u['bio'] ?: 'Votre présentation personnelle apparaîtra ici.') ?>
                </p>

                <div class="live-tags" id="preview-skills">
                    <?php
                    $skills = explode(',', $u['competences'] ?? '');

                    foreach ($skills as $skill):
                        $skill = trim($skill);
                        if ($skill):
                    ?>
                            <span><?= e($skill) ?></span>
                    <?php
                        endif;
                    endforeach;
                    ?>
                </div>

                <div class="live-details">

                    <div>
                        <b>Formation</b>
                        <p id="preview-formation">
                            <?= e($u['formation'] ?: 'Vos formations apparaîtront ici.') ?>
                        </p>
                    </div>

                    <div>
                        <b>Expérience</b>
                        <p id="preview-experience">
                            <?= e($u['experience'] ?: 'Vos expériences apparaîtront ici.') ?>
                        </p>
                    </div>

                    <div>
                        <b>Certifications</b>
                        <p id="preview-certifications">
                            <?= e($u['certifications'] ?: 'Vos certifications apparaîtront ici.') ?>
                        </p>
                    </div>

                    <div>
                        <b>Langues & intérêts</b>
                        <p id="preview-extra">
                            <?php
                            $extra = trim(
                                ($u['langues'] ?? '') .
                                    (!empty($u['centre_interet']) ? ' · ' . $u['centre_interet'] : '')
                            );

                            echo e($extra ?: 'Vos langues et centres d’intérêt apparaîtront ici.');
                            ?>
                        </p>
                    </div>

                </div>

                <div class="live-cv" id="preview-cv">
                    <?php if (!empty($u['cv_path'])): ?>
                        <span>📄 CV ajouté</span>
                        <a href="cv.php?id=<?= (int) $id ?>" target="_blank" rel="noopener">
                            Consulter le CV
                        </a>
                    <?php else: ?>
                        <span>📄 Votre CV apparaîtra ici après ajout.</span>
                    <?php endif; ?>
                </div>

                <div class="live-preview-footer">
                    Cet aperçu est indicatif. Enregistrez les informations pour les publier.
                </div>

            </div>
        </article>

        <a class="button-secondary live-open-profile"
            href="profil.php?id=<?= (int) $id ?>"
            target="_blank"
            rel="noopener">
            Ouvrir le portfolio public
        </a>

    </aside>

</div>


<!-- Mes projets -->
<section class="auth-card editor-card projects-editor portfolio-project-slide" id="realisations" hidden>

    <div class="carousel-slide-heading project-carousel-heading">
        <span class="carousel-slide-icon"><i class="fa-solid fa-folder-open"></i></span>
        <div>
            <span class="section-kicker">ÉTAPE 3</span>
            <h2>Projets</h2>
            <p>Présentez vos projets avec une description, une image et un lien.</p>
        </div>
    </div>

    <div class="portfolio-carousel-progress projects-progress" aria-label="Étapes du formulaire">
        <button type="button" class="carousel-step" data-show-identity-step><span>1</span> Identité</button>
        <button type="button" class="carousel-step" data-show-profile-step="1"><span>2</span> Formation & compétences</button>
        <button type="button" class="carousel-step is-active" aria-current="step"><span>3</span> Projets</button>
    </div>

    <form method="post" enctype="multipart/form-data" class="stack-form project-form">

        <input type="hidden" name="csrf" value="<?= e($_SESSION['csrf']) ?>">
        <input type="hidden" name="action" value="add_project">

        <label>Titre du projet *
            <input name="titre" required minlength="2" maxlength="180"
                placeholder="Ex. Création d'un site vitrine">
        </label>

        <label>Description du projet
            <textarea name="description" rows="4"
                placeholder="Objectif, rôle et résultats du projet..."></textarea>
        </label>

        <label>Image du projet <span class="muted">(JPG, PNG, WEBP · 3 Mo max.)</span>
            <input type="file" name="project_image" accept="image/jpeg,image/png,image/webp">
            <small>Ajoutez une capture d'écran ou une photo de votre réalisation.</small>
        </label>

        <label>Lien du projet <span class="muted">(facultatif)</span>
            <input type="url" name="lien" placeholder="https://...">
        </label>

        <button class="button-primary" type="submit">
            + Ajouter cette réalisation
        </button>

    </form>

    <div class="portfolio-carousel-actions projects-carousel-actions">
        <button class="button-secondary carousel-prev" type="button" data-show-profile-step="1">
            ← Précédent
        </button>
        <?php if (($u['payment_status'] ?? 'unpaid') !== 'paid'): ?>
            <a class="button-primary projects-publish-payment" href="paiement.php">
                <i class="fa-solid fa-paper-plane"></i>
                <span>Publier mon portfolio en ligne</span>
            </a>
        <?php endif; ?>
    </div>

    <h3 class="form-section-title">Projets publiés (<?= count($projects) ?>)</h3>

    <?php if ($projects): ?>

        <div class="project-manage-grid">

            <?php foreach ($projects as $project): ?>
                <article class="project-manage-card">

                    <?php if (!empty($project['image'])): ?>
                        <img src="<?= e($project['image']) ?>" alt="<?= e($project['titre']) ?>">
                    <?php else: ?>
                        <div class="project-manage-placeholder">✳</div>
                    <?php endif; ?>

                    <div class="project-manage-content">

                        <h4><?= e($project['titre']) ?></h4>
                        <p><?= e($project['description'] ?? '') ?></p>

                        <?php if (!empty($project['lien'])): ?>
                            <a href="<?= e($project['lien']) ?>" target="_blank" rel="noopener">
                                Ouvrir le lien ↗
                            </a>
                        <?php endif; ?>

                        <form method="post"
                            onsubmit="return confirm('Supprimer cette réalisation ?');">

                            <input type="hidden" name="csrf" value="<?= e($_SESSION['csrf']) ?>">
                            <input type="hidden" name="action" value="delete_project">
                            <input type="hidden" name="project_id" value="<?= (int) $project['id'] ?>">

                            <button class="button-secondary danger-button" type="submit">
                                Supprimer
                            </button>

                        </form>

                    </div>
                </article>
            <?php endforeach; ?>

        </div>

    <?php else: ?>

        <div class="empty-state">

            <h3>Aucun projet pour le moment</h3>
            <p>Utilisez le formulaire ci-dessus pour présenter votre première réalisation.</p>
        </div>

    <?php endif; ?>

</section>

<!-- Zone sensible -->
<dialog class="dashboard-modal danger-zone-modal" id="supprimer-compte" aria-labelledby="danger-zone-title">
    <div class="dashboard-modal-content account-danger-zone">
        <button class="dashboard-modal-close" type="button" data-close-dashboard-modal aria-label="Fermer">&times;</button>
        <h2 id="danger-zone-title">Zone sensible</h2>
        <p>Les actions de cette zone sont définitives. Vérifiez-les attentivement avant de continuer.</p>
        <button class="button-secondary danger-button" type="button" data-open-delete-account>
            Supprimer mon compte
        </button>
    </div>
</dialog>

<dialog class="delete-account-dialog" id="delete-account-dialog" aria-labelledby="delete-account-title">
    <form method="post" class="delete-account-dialog-content">

        <input type="hidden" name="csrf" value="<?= e($_SESSION['csrf']) ?>">
        <input type="hidden" name="action" value="delete_account">

        <div class="delete-account-icon" aria-hidden="true">
            <i class="fa-solid fa-triangle-exclamation"></i>
        </div>

        <h2 id="delete-account-title">Supprimer mon compte</h2>
        <p class="delete-account-warning">
            Cette action est définitive. Votre profil, votre CV, vos photos et tous vos projets seront supprimés.
        </p>

        <label>Confirmez avec votre mot de passe
            <input type="password" name="confirm_password"
                autocomplete="current-password" required>
        </label>

        <div class="delete-account-actions">
            <button class="button-secondary" type="button" data-close-delete-account>
                Annuler
            </button>
            <button class="button-secondary danger-button delete-account-confirm" type="submit">
                Supprimer définitivement
            </button>
        </div>

    </form>
</dialog>

<?php require 'includes/footer.php'; ?>