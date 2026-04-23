<?php
// Connexion à la base de donnée
$host = "localhost";
$dbname = "inscription_db";
$username = "root";
$password = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("erreur de connexion : " . $e->getMessage());
}

//Verifie si un user existe déjà 
$sqlCheck = "SELECT COUNT(*) FROM inscriptions
WHERE nom = ? AND prenom = ? AND date = ? AND telephone = ? AND quartier = ? AND sexe =?";
$stmtCheck = $pdo->prepare($sqlCheck);
$stmtCheck->execute([
    $_POST['nom'],
    $_POST['prenom'],
    $_POST['date'],
    $_POST['telephone'],
    $_POST['quartier'],
    $_POST['sexe'],
]);
$exists = $stmtCheck->fetchColumn();
if ($exists > 0) {
    echo "Cet utilisateur est déjà inscrit";
} else {
    $formations = implode(", ", $_POST['formation']);
    $sql = "INSERT INTO inscriptions
    (nom, prenom, date, telephone, quartier, sexe, formation)  VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    try {
        $stmt->execute([
            $_POST['nom'],
            $_POST['prenom'],
            $_POST['date'],
            $_POST['telephone'],
            $_POST['quartier'],
            $_POST['sexe'],
            $formations
        ]);
        echo "INSCRIPTION VALIDE";
    } catch (PDOException $e) {
        die("erreur SQL : " . $e->getMessage());
    }
}
