<?php
require __DIR__ . '/admin_auth.php';
require __DIR__ . '/config.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) { header('Location: dashboard.php'); exit; }

$pdo = db();
$stmt = $pdo->prepare("SELECT photo FROM inscriptions WHERE id=?");
$stmt->execute([$id]);
$row = $stmt->fetch();

if ($row) {
    $stmt = $pdo->prepare("DELETE FROM inscriptions WHERE id=?");
    $stmt->execute([$id]);
    if (!empty($row['photo'])) {
        $file = __DIR__ . '/uploads/' . basename($row['photo']);
        if (is_file($file)) @unlink($file);
    }
}
header('Location: dashboard.php');
exit;
