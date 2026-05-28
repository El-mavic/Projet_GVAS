<?php

require 'traitement.php';

$id = $_GET['id'];
$type = $_GET['type'];

if ($type == 'inscription') {

    $stmt = $pdo->prepare(
        "UPDATE inscriptions SET deleted = 0 WHERE id = ?"
    );
} elseif ($type == 'contact') {

    $stmt = $pdo->prepare(
        "UPDATE utilisateurs SET deleted = 0 WHERE id = ?"
    );
} elseif ($type == 'temoignage') {

    $stmt = $pdo->prepare(
        "UPDATE temoignages SET deleted = 0 WHERE id = ?"
    );
} elseif ($type == 'abonnement') {

    $stmt = $pdo->prepare(
        "UPDATE abonnements SET deleted = 0 WHERE id = ?"
    );
} elseif ($type == 'commentaire') {

    $stmt = $pdo->prepare(
        "UPDATE commentaires SET deleted = 0 WHERE id = ?"
    );
}
$stmt->execute([$id]);

header("Location: corbeille.php");
exit();
