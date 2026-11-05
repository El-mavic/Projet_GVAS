
<?php
require_once __DIR__ . '/config.php';

// Vérifier que l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$id = (int) $_SESSION['user_id'];

// Publier le portfolio sans paiement
$stmt = $pdo->prepare("
    UPDATE users
    SET public = 1,
        payment_status = 'paid'
    WHERE id = ?
");

$stmt->execute([$id]);

// Retourner à la page du portfolio
header('Location: profil.php?success=publication');
exit;
