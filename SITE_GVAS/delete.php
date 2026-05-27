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

        // Vérifier si l'élément est déjà dans la corbeille
        $check = $pdo->prepare("SELECT deleted FROM $table WHERE id = ?");
        $check->execute([$id]);
        $item = $check->fetch();

        if ($item && $item['deleted'] == 1) {
            // Suppression définitive
            $sql = "DELETE FROM $table WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$id]);

            header("Location: corbeille.php?delete=success&t=" . time());
        } else {
            // Envoyer à la corbeille
            $sql = "UPDATE $table 
                    SET deleted = 1,
                        deleted_at = NOW()
                    WHERE id = ?";

            $stmt = $pdo->prepare($sql);
            $stmt->execute([$id]);

            header("Location: dashboard.php?delete=success&t=" . time());
        }

        exit();
    }
}

header("Location: dashboard.php");
exit();
