<?php
require 'session_admin.php';
require 'traitement.php';

if (isset($_GET['id']) && isset($_GET['type'])) {

    $id = intval($_GET['id']);
    $type = $_GET['type'];

    $tables = [
        'temoignage' => 'temoignages',
        'inscription' => 'inscriptions',
        'contact' => 'utilisateurs'
    ];

    if (array_key_exists($type, $tables)) {

        $table = $tables[$type];

        $sql = "UPDATE $table 
                SET deleted = 1,
                    deleted_at = NOW()
                WHERE id = ?";

        $stmt = $pdo->prepare($sql);

        $stmt->execute([$id]);
    }

    header("Location: dashboard.php?delete=success");
    exit();
}

header("Location: dashboard.php");
exit();
?>