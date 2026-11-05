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

<section class="dashboard-intro">

    <span class="section-kicker">VOTRE ESPACE PERSONNEL</span>

    <h1>Bonjour <?= e($u['nom']) ?> </h1>

    <p>Complétez votre profil, ajoutez votre CV et présentez vos réalisations.</p>

    <?php if (($u['payment_status'] ?? 'unpaid') === 'paid'): ?>
        <a class="profile-link dashboard-view" href="profil.php?id=<?= $id ?>">
            Voir mon portfolio public
        </a>
    <?php endif; ?>

</section>

<?php if ($erreur): ?><div class="alert dashboard-alert"><?= e($erreur) ?></div><?php endif; ?><?php if ($ok): ?><div class="success dashboard-alert"><?= e($ok) ?></div><?php endif; ?>
<?php if (($u['payment_status'] ?? 'unpaid') !== 'paid'): ?>

    <section class="auth-card editor-card" style="margin: 1rem 0; border: 1px solid #f0c36d;">

        <span class="section-kicker">ÉTAPE AVANT PUBLICATION</span>

        <h2>Votre portfolio n’est pas encore public</h2>
        <p class="bba">
            Enregistrez vos informations, puis payez les frais de publication.
            Votre profil sera visible sur l’accueil après confirmation du paiement
            par Yabetoo Pay.
        </p>


        <a class="button-primary btn-paiement" href="paiement.php">
            <i class="fas fa-lock"></i>
            <span>Publier mon portfolio</span>

        </a>

        <!-- <a class="button-primary btn-paiement" href="publier_test.php">
            <i class="fas fa-globe"></i>
            <span>Publier mon portfolio</span>
        </a> -->


        <p class="muted" style="margin-top: 0.75rem;">
            État du paiement : non payé
        </p>

    </section>

<?php else: ?>
    <div class="success dashboard-alert">Paiement confirmé. Vous pouvez gérer
        la visibilité de votre portfolio depuis le formulaire ci-dessous.</div>
<?php endif; ?>

<div class="profile-editor-layout">

    <section class="auth-card editor-card profile-editor-form">

        <h2>Compléter mon portfolio</h2>
        <p>Complétez vos informations et suivez leur aperçu en direct.</p>

        <form method="post" enctype="multipart/form-data" class="stack-form">

            <input type="hidden" name="csrf" value="<?= e($_SESSION['csrf']) ?>">
            <input type="hidden" name="action" value="save_profile">

            <h3 class="form-section-title">Informations principales</h3>

            <label>Nom complet
                <input name="nom" required minlength="2" value="<?= e($u['nom']) ?>">
            </label>

            <label>E-mail *
                <input type="email" name="email" required value="<?= e($u['email']) ?>">
            </label>

            <label>Métier ou spécialité
                <input name="metier" placeholder="Ex. Développeur web" value="<?= e($u['metier'] ?? '') ?>">
            </label>

            <label>Compétences <span class="muted">(séparées par des virgules)</span>
                <input name="competences" placeholder="PHP, gestion de projet, design..." value="<?= e($u['competences'] ?? '') ?>">
            </label>

            <label>Présentation personnelle
                <textarea name="bio" rows="5" placeholder="Présentez votre parcours..."><?= e($u['bio'] ?? '') ?></textarea>
            </label>

            <div class="form-two">
                <label>Téléphone
                    <input type="tel" name="telephone" value="<?= e($u['telephone'] ?? '') ?>">
                </label>

                <label>Ville / pays
                    <input name="localisation" value="<?= e($u['localisation'] ?? '') ?>">
                </label>
            </div>

            <h3 class="form-section-title">Détails complémentaires</h3>

            <label>Formation et études
                <textarea name="formation" rows="3" placeholder="Diplômes, écoles et formations..."><?= e($u['formation'] ?? '') ?></textarea>
            </label>

            <label>Expérience professionnelle
                <textarea name="experience" rows="4" placeholder="Expériences, missions et résultats..."><?= e($u['experience'] ?? '') ?></textarea>
            </label>

            <label>Certifications et distinctions
                <textarea name="certifications" rows="3" placeholder="Certificats, attestations, prix..."><?= e($u['certifications'] ?? '') ?></textarea>
            </label>

            <div class="form-two">
                <label>Langues
                    <input name="langues" placeholder="Français, anglais..." value="<?= e($u['langues'] ?? '') ?>">
                </label>

                <label>Centres d’intérêt
                    <input name="centre_interet" value="<?= e($u['centre_interet'] ?? '') ?>">
                </label>
            </div>

            <h3 class="form-section-title">Photo de profil, couverture et CV</h3>

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
                <p class="current-file">
                    CV actuel :
                    <a href="cv.php?id=<?= (int) $id ?>" target="_blank" rel="noopener noreferrer">
                        Consulter le CV ↗
                    </a>
                </p>
            <?php endif; ?>

            <label>CV <span class="muted">(PDF, DOC, DOCX · 5 Mo max.)</span>
                <input type="file" name="cv" accept=".pdf,.doc,.docx">
                <small>Laissez vide pour conserver le CV actuel.</small>
            </label>

            <h3 class="form-section-title">Liens professionnels</h3>

            <label>Site web
                <input type="url" name="site_web" placeholder="https://..." value="<?= e($u['site_web'] ?? '') ?>">
            </label>

            <label>LinkedIn
                <input type="url" name="linkedin" placeholder="https://linkedin.com/in/..." value="<?= e($u['linkedin'] ?? '') ?>">
            </label>

            <?php if (($u['payment_status'] ?? 'unpaid') === 'paid'): ?>

                <label class="checkbox-label">
                    <input type="checkbox" name="public" value="1" <?= !empty($u['public']) ? 'checked' : '' ?>>
                    Mon portfolio est visible dans les recherches
                </label>

            <?php else: ?>

                <p class="muted">
                    La visibilité publique sera activée après confirmation du paiement.
                </p>

            <?php endif; ?>

            <button class="button-primary" type="submit">
                Enregistrer les informations →
            </button>

        </form>

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
<section class="auth-card editor-card projects-editor" id="realisations">

    <span class="section-kicker">VOTRE TRAVAIL</span>

    <h2>Mes réalisations et projets</h2>
    <p>Présentez vos projets avec une description, une image et un lien.</p>

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
            + Publier cette réalisation
        </button>

    </form>

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

<!-- Suppression du compte -->
<section class="auth-card editor-card account-danger-zone" id="supprimer-compte">

    <span class="section-kicker">ZONE SENSIBLE</span>

    <h2>Supprimer mon compte</h2>
    <p>Cette action est définitive. Votre profil, votre CV, vos photos et tous vos projets seront supprimés.</p>

    <form method="post" class="stack-form"
        onsubmit="return confirm('Confirmez-vous la suppression définitive de votre compte et de tous vos projets ? Cette action est irréversible.');">

        <input type="hidden" name="csrf" value="<?= e($_SESSION['csrf']) ?>">
        <input type="hidden" name="action" value="delete_account">

        <label>Confirmez avec votre mot de passe
            <input type="password" name="confirm_password"
                autocomplete="current-password" required>
        </label>

        <button class="button-secondary danger-button" type="submit">
            Supprimer définitivement mon compte
        </button>

    </form>

</section>

<?php require 'includes/footer.php'; ?>