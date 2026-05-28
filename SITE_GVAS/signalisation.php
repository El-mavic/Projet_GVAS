<?php
require 'traitement.php';

if (isset($_POST['message'])) {

    $message = trim($_POST['message']);
    $duree = intval($_POST['duree']);

    if (!empty($message)) {

        $dateExpiration = date(
            'Y-m-d H:i:s',
            strtotime("+$duree hours")
        );

        $pdo->query("UPDATE signalisation SET actif = 0");

        $stmt = $pdo->prepare(
            "INSERT INTO signalisation (message, actif, date_expiration) 
             VALUES (?, 1, ?)"
        );

        $stmt->execute([$message, $dateExpiration]);
    }
}

header("Location: dashboard.php");
exit();
?>