<?php
session_start();
require __DIR__ . '/config.php';

if (!empty($_SESSION['admin_id'])) {
    header('Location: dashboard.php');
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    try {
        $pdo = db();
        $stmt = $pdo->prepare("SELECT * FROM admins WHERE username = :username LIMIT 1");
        $stmt->execute([':username' => $username]);
        $admin = $stmt->fetch();

        if ($admin && password_verify($password, $admin['password'])) {
            session_regenerate_id(true);
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_username'] = $admin['username'];
            header('Location: dashboard.php');
            exit;
        }
        $error = 'Identifiants incorrects.';
    } catch (PDOException $e) {
        $error = 'Impossible de se connecter à la base de données.';
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Administration GVAS</title>
<link rel="stylesheet" href="admin.css">
</head>
<body class="login-page">
<div class="login-card">
    <div class="login-logo">GV</div>
    <p class="kicker">ESPACE ADMINISTRATEUR</p>
    <h1>Gestion des inscriptions</h1>
    <p class="muted">Connectez-vous pour gérer les participants du Programme Vacances Utiles.</p>
    <?php if ($error): ?><div class="alert error"><?= htmlspecialchars($error) ?></div><?php endif; ?>
    <form method="post">
        <label>Nom d'utilisateur
            <input name="username" required autocomplete="username" placeholder="admin">
        </label>
        <label>Mot de passe
            <input type="password" name="password" required autocomplete="current-password" placeholder="••••••••">
        </label>
        <button class="btn primary full">Se connecter</button>
    </form>
    <a class="back" href="index.php">← Retour au formulaire</a>
</div>
</body>
</html>
