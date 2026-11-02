<?php
require __DIR__ . '/config.php';
if (!empty($_SESSION['admin_id'])) {
    header('Location: admin_dashboard.php');
    exit;
}
$erreur = '';
if (empty($_SESSION['csrf'])) $_SESSION['csrf'] = bin2hex(random_bytes(32));
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!hash_equals($_SESSION['csrf'] ?? '', (string)($_POST['csrf'] ?? ''))) {
        $erreur = 'Session expirée. Rechargez la page.';
    } else {
        $username = trim((string)($_POST['username'] ?? ''));
        $password = (string)($_POST['password'] ?? '');
        try {
            $stmt = $pdo->prepare('SELECT id, username, password_hash FROM admin_accounts WHERE username = ? LIMIT 1');
            $stmt->execute([$username]);
            $admin = $stmt->fetch();
            if ($admin && password_verify($password, $admin['password_hash'])) {
                session_regenerate_id(true);
                $_SESSION['admin_id'] = (int)$admin['id'];
                $_SESSION['admin_username'] = $admin['username'];
                $_SESSION['admin_csrf'] = bin2hex(random_bytes(32));
                $_SESSION['csrf'] = bin2hex(random_bytes(32));
                header('Location: admin_dashboard.php');
                exit;
            }
            $erreur = 'Identifiant ou mot de passe incorrect.';
        } catch (PDOException $ex) {
            $erreur = 'La table administrateur n’est pas encore installée. Exécutez migration_admin.sql dans phpMyAdmin.';
        }
    }
}
$pageTitle = 'Connexion administrateur';
require __DIR__ . '/includes/header.php';
?>
<section class="auth-card admin-login-card">
    <span class="section-kicker">ACCÈS RESTREINT</span>
    <h1>Administration</h1>
    <p>Connectez-vous pour suivre les comptes, les portfolios et les paiements.</p>
    <?php if ($erreur): ?><div class="alert"><?= e($erreur) ?></div><?php endif; ?>
    <form method="post" class="stack-form" autocomplete="on">
        <input type="hidden" name="csrf" value="<?= e($_SESSION['csrf']) ?>">
        <label>Identifiant administrateur<input name="username" autocomplete="username" required maxlength="80" value="<?= e($_POST['username'] ?? 'admin') ?>"></label>
        <label>Mot de passe<input type="password" name="password" autocomplete="current-password" required></label>
        <button class="button-primary" type="submit">Accéder au dashboard </button>
    </form>
    <p class="auth-bottom"><a href="index.php"> Retour à l’accueil</a></p>
</section>
<?php require __DIR__ . '/includes/footer.php'; ?>