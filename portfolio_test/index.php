<?php

require 'config.php';

// ========================================
// 1. CONFIGURATION DE LA PAGE
// ========================================

$pageTitle = 'Recherche de portfolios';

$q      = trim($_GET['q'] ?? '');
$metier = trim($_GET['metier'] ?? '');

$page = max(1, (int) ($_GET['page'] ?? 1));

$perPage = 8;


// ========================================
// 2. CONSTRUCTION DE LA RECHERCHE SQL
// ========================================

// Afficher uniquement les portfolios publics et payés
$where = [
    "public = 1",
    "payment_status = 'paid'"
];

$params = [];


// Recherche par nom, métier, compétences ou biographie
if ($q !== '') {

    $where[] = "(
        nom LIKE :q_nom
        OR metier LIKE :q_metier
        OR competences LIKE :q_competences
        OR bio LIKE :q_bio
    )";

    $motCle = '%' . $q . '%';

    $params['q_nom']         = $motCle;
    $params['q_metier']      = $motCle;
    $params['q_competences'] = $motCle;
    $params['q_bio']         = $motCle;
}


// Filtrer par métier
if ($metier !== '') {

    $where[] = "metier LIKE :metier";
    $params['metier'] = '%' . $metier . '%';
}


// Préparer la condition SQL complète
$sqlWhere = implode(' AND ', $where);


// ========================================
// 3. COMPTER LES PROFILS TROUVÉS
// ========================================

$sqlCount = "
    SELECT COUNT(*)
    FROM users
    WHERE $sqlWhere
";

$count = $pdo->prepare($sqlCount);
$count->execute($params);

$total = (int) $count->fetchColumn();


// ========================================
// 4. CALCULER LA PAGINATION
// ========================================

$pages = max(1, (int) ceil($total / $perPage));

$page = min($page, $pages);

$offset = ($page - 1) * $perPage;


// ========================================
// 5. RÉCUPÉRER LES PROFILS
// ========================================

$sql = "
    SELECT
        id,
        nom,
        metier,
        bio,
        competences,
        photo,
        cover_photo,
        cv_path
    FROM users
    WHERE $sqlWhere
    ORDER BY nom ASC
    LIMIT $perPage OFFSET $offset
";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);

$profils = $stmt->fetchAll();


// ========================================
// 6. AFFICHER L'EN-TÊTE
// ========================================

require 'includes/header.php';

?>

<!-- ========================================
     7. SECTION D'ACCUEIL ET RECHERCHE
========================================= -->

<section class="hero">
    <div class="left">
        <div class="hero-glow"></div>

        <span class="eyebrow">
            <span class="pulse"></span>
            BIENVENUE SUR PROFOLIO !
        </span>

        <h1>
            Trouvez le talent<br>
            <em>qui vous correspond.</em>
        </h1>

        <p class="hero-copy">
            Explorez des profils inspirants, découvrez des compétences
            et donnez vie à vos projets.
        </p>

        <form class="search-form" action="index.php" method="get">

            <input
                type="search"
                name="q"
                value="<?= e($q) ?>"
                placeholder="Un nom, un métier, une compétence…"
                aria-label="Recherche">

            <button type="submit" aria-label="Rechercher">
                <i class="fas fa-search"></i>
            </button>

        </form>

        <!-- Suggestions de recherche -->

        <div class="suggestions">

            <span>Suggestions :</span>

            <?php
            $suggestions = [

                'Designer',
                'Marketing',
                'Formateur'
            ];

            foreach ($suggestions as $suggestion):
            ?>

                <a href="index.php?metier=<?= urlencode($suggestion) ?>">
                    <?= e($suggestion) ?>
                </a>

            <?php endforeach; ?>

        </div>

    </div>
    <div class="hero-droite">
        <div class="cercle-grand"></div>
        <div class="cercle-moyen"></div>

        <img src="Mes_images/group.png" class="orbe orbe-1">
        <img src="Mes_images/pers.png" class="orbe orbe-3">
        <img src="Mes_images/work.png" class="orbe orbe-4">

        <div class="phone">
            <div class="phone- bar"></div>
            <div class="phone-screen">
                <img src="Mes_images/pic.png" alt="Aperçu portfolio" style="width:100%; object-fit:cover; margin:0; border-radius:8px;">
                <img src="Mes_images/test1.jpg" alt="Aperçu portfolio" style="width:100%; object-fit:cover; margin:0; border-radius:8px;">
                <img src="Mes_images/test2.jpg" alt="Aperçu portfolio" style="width:100%; object-fit:cover; margin:0; border-radius:8px;">


            </div>
        </div>
    </div>


</section>


<!-- ========================================
     8. TITRE DES RÉSULTATS ET FILTRES
========================================= -->

<section class="results-head">

    <div>
        <h2>
            <?= ($q !== '' || $metier !== '')
                ? 'Résultats de recherche'
                : 'Des profils à découvrir' ?>
        </h2>

        <p>
            <?= $total ?>
            profil<?= $total > 1 ? 's' : '' ?>
            trouvé<?= $total > 1 ? 's' : '' ?>

            <?php if ($q !== ''): ?>
                pour « <?= e($q) ?> »
                <?php endif; ?>.
        </p>

    </div>


    <!-- Filtre par métier -->

    <form method="get" class="filter-form">

        <input
            type="hidden"
            name="q"
            value="<?= e($q) ?>">

        <label for="metier">
            Filtrer par métier
        </label>

        <select
            name="metier"
            id="metier"
            onchange="this.form.submit()">

            <option value="">Tous les métiers</option>

            <?php
            $metiers = [
                'Développeur',
                'Designer',
                'Marketing',
                'Formateur',
                'Photographe',
                'Rédacteur'
            ];

            foreach ($metiers as $m):
            ?>

                <option
                    value="<?= e($m) ?>"
                    <?= $metier === $m ? 'selected' : '' ?>>
                    <?= e($m) ?>
                </option>

            <?php endforeach; ?>

        </select>

    </form>

</section>


<!-- ========================================
     9. AFFICHER LES CARTES DES PROFILS
========================================= -->

<?php if (!empty($profils)): ?>

    <div class="profile-grid">

        <?php foreach ($profils as $p): ?>

            <?php

            // Initiale du nom pour l'avatar
            $initiales = mb_strtoupper(
                mb_substr($p['nom'], 0, 1, 'UTF-8'),
                'UTF-8'
            );


            // Limiter les compétences affichées à quatre
            $competences = array_slice(
                array_filter(
                    array_map(
                        'trim',
                        explode(',', (string) $p['competences'])
                    )
                ),
                0,
                4
            );

            ?>

            <article class="profile-card">

                <!-- Image de couverture -->

                <?php
                $coverPhoto = $p['cover_photo'] ?? '';
                ?>

                <div class="card-cover"
                    <?php if ($coverPhoto !== ''): ?>
                    style="background-image: url('<?= e($coverPhoto) ?>');
               background-size: cover;
               background-position: center;"
                    <?php endif; ?>>
                    <span class="cover-symbol">✳</span>
                </div>

                <!-- Photo de profil -->

                <div class="avatar-wrap">

                    <?php if (!empty($p['photo'])): ?>

                        <img
                            class="avatar"
                            src="<?= e($p['photo']) ?>"
                            alt="Photo de <?= e($p['nom']) ?>"
                            loading="lazy">

                    <?php else: ?>

                        <div class="avatar avatar-placeholder">
                            <?= e($initiales) ?>
                        </div>

                    <?php endif; ?>

                </div>


                <!-- Informations du profil -->

                <div class="profile-content">

                    <h3><?= e($p['nom']) ?></h3>

                    <p class="job-title">
                        <?= e($p['metier'] ?: 'Professionnel') ?>
                    </p>

                    <p class="bio">

                        <?= e(
                            mb_strimwidth(
                                (string) $p['bio'],
                                0,
                                115,
                                '…',
                                'UTF-8'
                            ) ?: 'Ce membre n’a pas encore ajouté de présentation.'
                        ) ?>

                    </p>


                    <!-- Compétences -->

                    <div class="tags">

                        <?php foreach ($competences as $competence): ?>

                            <span><?= e($competence) ?></span>

                        <?php endforeach; ?>

                    </div>


                    <!-- Lien vers le portfolio -->

                    <a
                        class="profile-link"
                        href="profil.php?id=<?= (int) $p['id'] ?>">
                        Voir le portfolio <span>↗</span>
                    </a>


                    <!-- Lien vers le CV -->

                    <?php if (!empty($p['cv_path'])): ?>

                        <a
                            class="cv-card-link"
                            href="cv.php?id=<?= (int) $p['id'] ?>"
                            target="_blank"
                            rel="noopener">
                            Consulter le CV ↗
                        </a>

                    <?php endif; ?>

                </div>

            </article>

        <?php endforeach; ?>

    </div>


    <!-- ========================================
         10. PAGINATION
    ========================================= -->

    <?php if ($pages > 1): ?>

        <nav class="pagination" aria-label="Pagination">

            <?php for ($i = 1; $i <= $pages; $i++): ?>

                <a
                    class="<?= $i === $page ? 'current' : '' ?>"
                    href="?<?= http_build_query([
                                'q'      => $q,
                                'metier' => $metier,
                                'page'   => $i
                            ]) ?>">
                    <?= $i ?>
                </a>

            <?php endfor; ?>

        </nav>

    <?php endif; ?>


<?php else: ?>


    <!-- ========================================
         11. AUCUN RÉSULTAT
    ========================================= -->

    <div class="empty-state">

        <div class="empty-icon">⌕</div>

        <h3>Aucun profil trouvé</h3>

        <p>
            Essayez un autre nom, métier ou mot-clé.
        </p>

        <a class="button-primary" href="index.php">
            Voir tous les profils
        </a>

    </div>

<?php endif; ?>


<!-- ========================================
     12. PRÉSENTATION DE PROFOLIO
========================================= -->

<section class="profolio-about reveal">
    <div class="profolio-about-heading">
        <h1 class="section-kicker">Votre talent, raconté avec confiance.</h1>
        <h2>À PROPOS DE LA PLATE-FORME PROFOLIO</h2>
        <p>
            Profolio est une plateforme numérique pensée pour donner à chaque professionnel,
            étudiant ou créateur un espace moderne afin de présenter son parcours, ses compétences,
            ses réalisations et son identité professionnelle.
        </p>
    </div>

    <div class="profolio-about-grid">
        <article>
            <span class="profolio-about-icon"><i class="fa-solid fa-bullseye"></i></span>
            <h3>Notre objectif</h3>
            <p>Rendre les talents visibles et faciliter la rencontre entre les profils qualifiés, les recruteurs et les porteurs de projets.</p>
        </article>
        <article>
            <span class="profolio-about-icon"><i class="fa-solid fa-person-rays"></i></span>
            <h3>Son rôle</h3>
            <p>Profolio agit comme un portefeuille professionnel vivant : vous y centralisez votre expérience, votre CV et vos projets dans une seule vitrine.</p>
        </article>
        <article>
            <span class="profolio-about-icon"><i class="fa-solid fa-gem"></i></span>
            <h3>Son importance</h3>
            <p>Une présence professionnelle claire inspire davantage de confiance, ouvre de nouvelles opportunités et valorise chaque réalisation.</p>
        </article>
        <article>
            <span class="profolio-about-icon"><i class="fa-solid fa-shield-halved"></i></span>
            <h3>Une plateforme maîtrisée</h3>
            <p>Un tableau de bord simple vous permet de gérer vos informations, de contrôler votre visibilité publique et de partager votre portfolio en toute confiance.</p>
        </article>
    </div>

    <div class="profolio-bhs-signature">
        <img src="../Mes_images/logo.png" alt="Logo BHS, équipe créatrice de Profolio">
        <div>
            <span>Création de la plateforme</span>
            <strong>Équipe BHS</strong>
            <p>Profolio est une création de l’équipe BHS, conçue pour transformer les profils professionnels en opportunités concrètes.</p>
            <a class="bhs-contact-button" href="#" aria-label="Nous contacter, portfolio BHS bientôt disponible">
                <i class="fa-solid fa-paper-plane"></i>
                Nous contacter
            </a>
        </div>
    </div>
</section>

<!-- ========================================
     13. COMMENT ÇA MARCHE
========================================= -->

<section class="profolio-how-it-works reveal">
    <div class="profolio-how-heading">
        <span class="section-kicker">COMMENT ÇA MARCHE ?</span>
        <h2>Votre parcours sur Profolio, en quelques étapes</h2>
        <p>De votre première recherche à la publication de votre portfolio, chaque étape est simple et guidée.</p>
    </div>

    <div class="profolio-steps">
        <article class="profolio-step">
            <span class="profolio-step-number">01</span>
            <span class="profolio-step-icon"><i class="fa-solid fa-magnifying-glass"></i></span>
            <h3>Explorez les profils</h3>
            <p>Recherchez un professionnel par son nom, son métier ou une compétence précise, puis consultez les portfolios correspondant à vos besoins.</p>
        </article>

        <article class="profolio-step">
            <span class="profolio-step-number">02</span>
            <span class="profolio-step-icon"><i class="fa-solid fa-user-plus"></i></span>
            <h3>Créez votre compte</h3>
            <p>Inscrivez-vous gratuitement avec vos informations personnelles. Votre espace professionnel est ensuite accessible depuis la connexion.</p>
        </article>

        <article class="profolio-step">
            <span class="profolio-step-number">03</span>
            <span class="profolio-step-icon"><i class="fa-solid fa-address-card"></i></span>
            <h3>Complétez votre portfolio</h3>
            <p>Depuis votre tableau de bord, ajoutez votre présentation, vos compétences, votre formation, votre CV et vos réalisations.</p>
        </article>

        <article class="profolio-step">
            <span class="profolio-step-number">04</span>
            <span class="profolio-step-icon"><i class="fa-solid fa-cloud-arrow-up"></i></span>
            <h3>Mettez-vous en ligne</h3>
            <p>Après vérification du paiement, votre portfolio peut devenir public et être découvert directement depuis les résultats de recherche.</p>
        </article>
    </div>

    <a class="profolio-how-button" href="register.php">
        Commencer maintenant
        <i class="fa-solid fa-arrow-right"></i>
    </a>
</section>

<!-- ========================================
     14. INVITATION À CRÉER UN PORTFOLIO
========================================= -->

<section class="join-banner">

    <div>
        <h2>
            Et si le prochain profil était le vôtre ?
        </h2>

        <p>
            Créez votre espace et partagez vos projets
            avec la communauté.
        </p>

    </div>

    <a class="button-light" href="register.php">
        Créer mon portfolio
    </a>

</section>


<!-- ========================================
     13. PIED DE PAGE
========================================= -->

<?php require 'includes/footer.php'; ?>