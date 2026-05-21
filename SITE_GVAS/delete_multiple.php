<?php

require 'connexion.php';

if (isset($_POST['selected_ids'])) {

    $ids = $_POST['selected_ids'];

    foreach ($ids as $id) {

        $sql = "UPDATE inscriptions
                SET deleted = 1
                WHERE id = ?";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
    }
}

header("Location: dashboard.php");
exit;
