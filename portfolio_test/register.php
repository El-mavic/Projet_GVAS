<?php
require 'config.php';
if (!empty($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit;
}
$erreur = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!hash_equals($_SESSION['csrf'] ?? '', $_POST['csrf'] ?? '')) {
        $erreur = 'Session expirée. Rechargez la page.';
    } else {
        $nom = trim($_POST['nom'] ?? '');
        $email = filter_var(trim($_POST['email'] ?? ''), FILTER_VALIDATE_EMAIL);
        $telephone = trim($_POST['telephone'] ?? '');
        $pass = (string)($_POST['password'] ?? '');
        $confirm = (string)($_POST['password_confirm'] ?? '');
        if (mb_strlen($nom) < 2 || !$email) {
            $erreur = 'Veuillez saisir un nom complet et une adresse e-mail valides.';
        } elseif ($telephone === '' && !$email) {
            $erreur = 'Indiquez au moins un e-mail ou un numéro de téléphone.';
        } elseif (strlen($pass) < 8) {
            $erreur = 'Le mot de passe doit contenir au moins 8 caractères.';
        } elseif ($pass !== $confirm) {
            $erreur = 'Les deux mots de passe ne correspondent pas.';
        } else {
            try {
                $stmt = $pdo->prepare("INSERT INTO users (nom, email, password_hash, telephone, public, payment_status) VALUES (?, ?, ?, ?, 0, 'unpaid')");
                $stmt->execute([$nom, $email, password_hash($pass, PASSWORD_DEFAULT), $telephone !== '' ? $telephone : null]);
                session_regenerate_id(true);
                $_SESSION['user_id'] = (int)$pdo->lastInsertId();
                header('Location: dashboard.php?bienvenue=1');
                exit;
            } catch (PDOException $ex) {
                $erreur = $ex->getCode() === '23000' ? 'Cette adresse e-mail possède déjà un compte.' : 'Impossible de créer le compte. Vérifiez la structure de la base de données.';
            }
        }
    }
}
$_SESSION['csrf'] = bin2hex(random_bytes(32));
$pageTitle = 'Créer un compte';
require 'includes/header.php';
?>

<section class="auth-card auth-wide register-card">

    <span class="section-kicker">REJOIGNEZ LA COMMUNAUTÉ</span>

    <h1>Créer un compte.</h1>
    <p>Renseignez vos informations pour commencer.</p>

    <?php if ($erreur): ?>
        <div class="alert"><?= e($erreur) ?></div>
    <?php endif; ?>

    <form method="post" class="stack-form register-form" novalidate>

        <input type="hidden" name="csrf" value="<?= e($_SESSION['csrf']) ?>">

        <label>
            Nom complet *
            <input
                type="text"
                name="nom"
                required
                minlength="2"
                autocomplete="name"
                placeholder="Votre nom complet"
                value="<?= e($_POST['nom'] ?? '') ?>">
        </label>

        <label>
            Adresse e-mail *
            <input
                type="email"
                name="email"
                required
                autocomplete="email"
                placeholder="exemple@mail.com"
                value="<?= e($_POST['email'] ?? '') ?>">
        </label>

        <label>
            Téléphone
            <input
                type="tel"
                name="telephone"
                autocomplete="tel"
                placeholder="+242 06 000 00 00"
                value="<?= e($_POST['telephone'] ?? '') ?>">
            <small>Vous pourrez compléter votre profil après la création du compte.</small>
        </label>

        <label>
            Mot de passe
            <input
                type="password"
                name="password"
                required
                minlength="8"
                autocomplete="new-password"
                placeholder="8 caractères minimum">
        </label>

        <label>
            Confirmer le mot de passe
            <input
                type="password"
                name="password_confirm"
                required
                minlength="8"
                autocomplete="new-password"
                placeholder="Répétez le mot de passe">
        </label>

        <button class="button-primary" type="submit">
            Créer mon compte
        </button>

    </form>

    <p class="auth-bottom">
        Vous avez déjà un compte ?
        <a href="login.php">Se connecter</a>
    </p>

</section>

<?php require 'includes/footer.php'; ?>