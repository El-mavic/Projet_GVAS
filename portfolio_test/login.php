
<?php
require 'config.php';

// Rediriger si l'utilisateur est déjà connecté
if (!empty($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit;
}

$erreur = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Vérifier le jeton de sécurité
    if (!hash_equals($_SESSION['csrf'] ?? '', $_POST['csrf'] ?? '')) {
        $erreur = 'Session expirée. Rechargez la page.';
    } else {

        // Récupérer les informations du formulaire
        $email = filter_var(
            trim($_POST['email'] ?? ''),
            FILTER_VALIDATE_EMAIL
        );

        $password = $_POST['password'] ?? '';

        // Rechercher le compte
        $stmt = $pdo->prepare(
            'SELECT id, password_hash FROM users WHERE email = ?'
        );

        $stmt->execute([$email ?: '']);
        $user = $stmt->fetch();

        // Vérifier le mot de passe
        if ($user && password_verify($password, $user['password_hash'])) {

            session_regenerate_id(true);

            $_SESSION['user_id'] = (int) $user['id'];

            header('Location: dashboard.php');
            exit;
        } else {
            $erreur = 'Adresse e-mail ou mot de passe incorrect.';
        }
    }
}

// Créer un nouveau jeton de sécurité
$_SESSION['csrf'] = bin2hex(random_bytes(32));

$pageTitle = 'Connexion';

require 'includes/header.php';
?>

<section class="auth-card">

    <span class="section-kicker">HEUREUX DE VOUS REVOIR</span>

    <h1>Connexion</h1>

    <p>Connectez-vous pour gérer votre portfolio.</p>

    <?php if ($erreur): ?>
        <div class="alert">
            <?= e($erreur) ?>
        </div>
    <?php endif; ?>

    <form method="post" class="stack-form">

        <input
            type="hidden"
            name="csrf"
            value="<?= e($_SESSION['csrf']) ?>">

        <label>
            E-mail
            <input
                type="email"
                name="email"
                required
                autocomplete="email"
                value="<?= e($_POST['email'] ?? '') ?>">
        </label>

        <label>
            Mot de passe
            <input
                type="password"
                name="password"
                required
                autocomplete="current-password">
        </label>

        <button class="button-primary" type="submit">
            Se connecter
        </button>

    </form>

    <p class="auth-bottom">
        Pas encore de compte ?
        <a href="register.php">Créer un compte</a>
    </p>

</section>

<?php require 'includes/footer.php'; ?>