<?php
require 'config.php';
$pageTitle = 'À propos de Profolio';
require 'includes/header.php';
?>

<section class="about-page-hero reveal">
    <h1>Une plateforme créée pour <span>faire rayonner les talents.</span></h1>
    <p>Découvrez l’histoire, les valeurs et le fonctionnement de Profolio, la vitrine professionnelle imaginée par l’équipe BHS.</p>
</section>

<section class="profolio-about reveal">
    <div class="profolio-about-heading">
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
            <a class="bhs-contact-button" href="#footer" aria-label="Nous contacter, portfolio BHS bientôt disponible">
                <i class="fa-solid fa-paper-plane"></i>
                Nous contacter
            </a>
        </div>
    </div>
</section>

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

<?php require 'includes/footer.php'; ?>
