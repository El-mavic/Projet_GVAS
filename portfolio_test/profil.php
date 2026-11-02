<?php
require 'config.php';
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    http_response_code(404);
    exit('Profil introuvable.');
}
$stmt = $pdo->prepare("SELECT id, nom, email, metier, bio, competences, photo, cover_photo, cv_path, telephone, localisation, formation, experience, certifications, langues, centre_interet, site_web, linkedin FROM users WHERE id = ? AND public = 1 AND payment_status = 'paid'");
$stmt->execute([$id]);
$profil = $stmt->fetch();
if (!$profil) {
    http_response_code(404);
    exit('Ce portfolio est introuvable ou privé.');
}
$stmt = $pdo->prepare('SELECT titre, description, image, lien FROM projets WHERE user_id = ? ORDER BY created_at DESC');
$stmt->execute([$id]);
$projets = $stmt->fetchAll();
$pageTitle = 'Portfolio de ' . $profil['nom'];
require 'includes/header.php';
$skills = array_filter(array_map('trim', explode(',', (string)$profil['competences'])));
$initial = mb_strtoupper(mb_substr($profil['nom'], 0, 1, 'UTF-8'), 'UTF-8');
?>

<a class="back-link" href="index.php">
    <i class="fas fa-arrow-left"></i>
    Retour aux profils
</a>

<!-- Image de couverture -->
<section class="portfolio-cover"
    <?php if (!empty($profil['cover_photo'])): ?>
    style="background-image: linear-gradient(90deg, rgba(9,26,61,.72), rgba(9,26,61,.08)), url('<?= e($profil['cover_photo']) ?>');"
    <?php endif; ?>>
    <span>PORTFOLIO PROFESSIONNEL</span>
</section>

<!-- Informations du profil -->
<section class="detail-hero detail-hero-overlap">

    <div class="detail-avatar">
        <?php if (!empty($profil['photo'])): ?>
            <img src="<?= e($profil['photo']) ?>" alt="Photo de <?= e($profil['nom']) ?>">
        <?php else: ?>
            <span><?= e($initial) ?></span>
        <?php endif; ?>
    </div>

    <div class="detail-info">
        <span class="section-kicker">PORTFOLIO PUBLIC</span>

        <h1><?= e($profil['nom']) ?></h1>

        <p class="detail-job">
            <i class="fas fa-briefcase"></i>
            <?= e($profil['metier'] ?: 'Professionnel') ?>
        </p>

        <?php if (!empty($profil['localisation'])): ?>
            <p class="detail-meta">
                <i class="fas fa-map-marker-alt"></i>
                <?= e($profil['localisation']) ?>
            </p>
        <?php endif; ?>

        <?php if (!empty($profil['bio'])): ?>
            <p><?= nl2br(e($profil['bio'])) ?></p>
        <?php else: ?>
            <p class="muted">Aucune présentation disponible.</p>
        <?php endif; ?>

        <!-- Compétences -->
        <div class="tags detail-tags">
            <?php foreach ($skills as $skill): ?>
                <span><?= e($skill) ?></span>
            <?php endforeach; ?>
        </div>

        <!-- Contacts et liens -->
        <div class="contact-links">

            <?php if (!empty($profil['cv_path'])): ?>
                <a class="cv-button"
                    href="cv.php?id=<?= (int) $profil['id'] ?>"
                    target="_blank"
                    rel="noopener">

                    Consulter le CV
                </a>
            <?php endif; ?>

            <?php if (!empty($profil['site_web']) && filter_var($profil['site_web'], FILTER_VALIDATE_URL)): ?>
                <a href="<?= e($profil['site_web']) ?>" target="_blank" rel="noopener">
                    <i class="fas fa-globe"></i>
                    Site web <i class="fas fa-external-link-alt"></i>
                </a>
            <?php endif; ?>

            <?php if (!empty($profil['linkedin']) && filter_var($profil['linkedin'], FILTER_VALIDATE_URL)): ?>
                <a href="<?= e($profil['linkedin']) ?>" target="_blank" rel="noopener">
                    <i class="fab fa-linkedin"></i>
                    LinkedIn <i class="fas fa-external-link-alt"></i>
                </a>
            <?php endif; ?>

            <?php if (!empty($profil['telephone'])): ?>
                <a href="tel:<?= e(preg_replace('/[^0-9+]/', '', $profil['telephone'])) ?>">
                    <i class="fas fa-phone"></i>
                    Téléphone : <?= e($profil['telephone']) ?>
                </a>
            <?php endif; ?>

            <a href="mailto:elmavicd@gmail.com<?= e($profil['email']) ?>">
                <i class="fas fa-envelope"></i>
                Contacter par e-mail
            </a>

        </div>
    </div>
</section>

<!-- Informations complémentaires -->
<section class="extra-details">

    <div class="results-head">
        <div>
            <span class="section-kicker">AU-DELÀ DU CV</span>
            <h2>En savoir plus</h2>
            <p>Informations complémentaires partagées par <?= e($profil['nom']) ?>.</p>
        </div>
    </div>

    <div class="details-grid">

        <?php
        $details = [
            ['Formation et études', 'formation', 'fas fa-graduation-cap'],
            ['Expérience professionnelle', 'experience', 'fas fa-briefcase'],
            ['Certifications et distinctions', 'certifications', 'fas fa-star'],
            ['Langues', 'langues', 'fas fa-language'],
            ['Centres d’intérêt', 'centre_interet', 'fas fa-heart']
        ];

        $hasDetails = false;
        ?>

        <?php foreach ($details as [$titre, $champ, $icone]): ?>

            <?php if (trim((string) ($profil[$champ] ?? '')) !== ''): ?>
                <?php $hasDetails = true; ?>

                <article class="detail-box">
                    <span class="detail-box-icon">
                        <i class="<?= e($icone) ?>"></i>
                    </span>

                    <h3><?= e($titre) ?></h3>
                    <p><?= nl2br(e($profil[$champ])) ?></p>
                </article>

            <?php endif; ?>

        <?php endforeach; ?>

        <?php if (!$hasDetails): ?>
            <div class="empty-state details-empty">
                <h3>Aucun détail complémentaire</h3>
                <p>La formation, l’expérience et les autres informations pourront être ajoutées ultérieurement.</p>
            </div>
        <?php endif; ?>

    </div>
</section>

<!-- Réalisations et projets -->
<section class="results-head project-heading">
    <div>
        <span class="section-kicker">SÉLECTION DE TRAVAUX</span>
        <h2>Ses réalisations</h2>

        <p>
            <?= count($projets) ?> Projet<?= count($projets) > 1 ? 's' : '' ?>
            présenté<?= count($projets) > 1 ? 's' : '' ?>
        </p>
    </div>
</section>

<?php if (!empty($projets)): ?>

    <div class="project-grid">

        <?php foreach ($projets as $project): ?>

            <article class="project-card">

                <?php if (!empty($project['image'])): ?>
                    <img src="<?= e($project['image']) ?>"
                        alt="<?= e($project['titre']) ?>"
                        loading="lazy">
                <?php else: ?>
                    <div class="project-placeholder">
                        <i class="fas fa-lightbulb"></i>
                    </div>
                <?php endif; ?>

                <div>
                    <h3><?= e($project['titre']) ?></h3>
                    <p><?= nl2br(e($project['description'])) ?></p>

                    <?php if (!empty($project['lien']) && filter_var($project['lien'], FILTER_VALIDATE_URL)): ?>
                        <a href="<?= e($project['lien']) ?>"
                            target="_blank"
                            rel="noopener">

                            Découvrir le projet
                        </a>
                    <?php endif; ?>
                </div>

            </article>

        <?php endforeach; ?>

    </div>

<?php else: ?>

    <div class="empty-state">
        <div class="empty-icon">
            <i class="fas fa-lightbulb"></i>
        </div>

        <h3>Les projets arrivent bientôt</h3>
        <p>Ce membre n’a pas encore publié de réalisation.</p>
    </div>

<?php endif; ?>

<?php require __DIR__ . '/includes/footer.php'; ?>