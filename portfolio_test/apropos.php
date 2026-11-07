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
            <a class="bhs-contact-button" href="#" aria-label="Nous contacter, portfolio BHS bientôt disponible">
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
</section>

<section class="public-feedback reveal" aria-labelledby="public-feedback-title">
    <div class="public-feedback-intro">
        <span class="section-kicker">SIGNALER OU NOUS ÉCRIRE</span>
        <h2 id="public-feedback-title">Votre voix nous aide à améliorer Profolio</h2>
        <p>Vous rencontrez un problème, vous avez une question ou une suggestion ? Laissez-nous un message. Nous lirons chaque signalement avec attention.</p>

        <div class="public-feedback-notice">
            <i class="fa-solid fa-shield-halved"></i>
            <p><strong>Vous pouvez être sincère.</strong><br>Votre message reste destiné à l’équipe de gestion de Profolio.</p>
        </div>
    </div>

    <form class="public-feedback-form" id="public-feedback-form" action="#" method="post">
        <div class="feedback-form-row">
            <label>
                Nom
                <input type="text" name="feedback_name" autocomplete="name" placeholder="Votre nom" required>
            </label>
            <label>
                Adresse e-mail
                <input type="email" name="feedback_email" autocomplete="email" placeholder="vous@exemple.com" required>
            </label>
        </div>

        <label>
            Objet du message
            <select name="feedback_subject" required>
                <option value="" selected disabled>Choisissez le type de message</option>
                <option value="question">Question</option>
                <option value="suggestion">Suggestion</option>
                <option value="problem">Problème technique</option>
                <option value="account">Compte ou connexion</option>
                <option value="other">Autre</option>
            </select>
        </label>

        <label>
            Votre message
            <textarea name="feedback_message" rows="6" maxlength="1000" placeholder="Expliquez-nous votre souci ou partagez votre suggestion…" required></textarea>
            <span class="feedback-character-count"><span id="feedback-character-current">0</span>/1000</span>
        </label>

        <div class="feedback-form-footer">
            <label class="feedback-consent">
                <input type="checkbox" name="feedback_contact_consent">
                <span>Je peux être recontacté à propos de ce message.</span>
            </label>
            <button class="public-feedback-submit" type="submit">
                <span>Envoyer le message</span>
                <i class="fa-solid fa-paper-plane"></i>
            </button>
        </div>
        <p class="public-feedback-status" id="public-feedback-status" role="status" aria-live="polite"></p>
    </form>
</section>

<?php require 'includes/footer.php'; ?>
