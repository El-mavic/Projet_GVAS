
<?php
// Connexion à la base de données
$host = "localhost";
$dbname = "inscription_db";
$username = "root";
$password = "";

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8",
        $username,
        $password
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}


/* =========================
   FORMULAIRE INSCRIPTIONS
========================= */
if (isset($_POST['form_type']) && $_POST['form_type'] === 'inscriptions') {

    $sqlCheck = "SELECT COUNT(*) FROM inscriptions
        WHERE nom = ? AND prenom = ? AND date = ? 
        AND telephone = ? AND quartier = ? AND sexe = ?";

    $stmtCheck = $pdo->prepare($sqlCheck);
    $stmtCheck->execute([
        $_POST['nom'],
        $_POST['prenom'],
        $_POST['date'],
        $_POST['telephone'],
        $_POST['quartier'],
        $_POST['sexe']
    ]);

    $exists = $stmtCheck->fetchColumn();

    if ($exists > 0) {
        header("Location: Succes.php?message=existe");
        exit();
    }

    $formations = implode(", ", $_POST['formation']);

    $sql = "INSERT INTO inscriptions
        (nom, prenom, date, telephone, quartier, sexe, formation)
        VALUES (?, ?, ?, ?, ?, ?, ?)";

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

        header("Location: Succes.php?message=ok");
        exit();
    } catch (PDOException $e) {
        die("Erreur SQL : " . $e->getMessage());
    }
}


/* =========================
   FORMULAIRE CONTACT
========================= */ elseif (isset($_POST['form_type']) && $_POST['form_type'] === 'contact') {

    $nom = trim($_POST['nom'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $sujet = trim($_POST['sujet'] ?? '');
    $message = trim($_POST['message'] ?? '');

    // Vérifier email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: Succes.php?message=email_invalide");
        exit();
    }

    // Gmail uniquement
    if (!preg_match('/^[a-zA-Z0-9._%+-]+@gmail\.com$/i', $email)) {
        header("Location: Succes.php?message=email_gmail_only");
        exit();
    }

    // Vérifier doublon
    $sqlCheck = "SELECT COUNT(*) FROM utilisateurs WHERE sujet = ? AND message = ?";
    $stmtCheck = $pdo->prepare($sqlCheck);
    $stmtCheck->execute([$sujet, $message]);

    if ($stmtCheck->fetchColumn() > 0) {
        header("Location: Succes.php?message=existe");
        exit();
    }

    // Insertion
    $sql = "INSERT INTO utilisateurs (nom, email, sujet, message)
            VALUES (?, ?, ?, ?)";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nom, $email, $sujet, $message]);

    header("Location: Succes.php?message=contact_ok");
    exit();
}


/* =========================
   FORMULAIRE TEMOIGNAGES
========================= */ elseif (isset($_POST['form_type']) && $_POST['form_type'] === 'temoignage') {

    $nom = trim($_POST['nom'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if (empty($nom) || empty($message)) {
        header("Location: Succes.php?message=champ_vide");
        exit();
    }

    // Vérifier doublon
    $sqlCheck = "SELECT COUNT(*) FROM temoignages WHERE nom = ? AND message = ?";
    $stmtCheck = $pdo->prepare($sqlCheck);
    $stmtCheck->execute([$nom, $message]);

    if ($stmtCheck->fetchColumn() > 0) {
        header("Location: Succes.php?message=existe");
        exit();
    }

    // Insertion
    $sql = "INSERT INTO temoignages (nom, message) VALUES (?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nom, $message]);

    header("Location: temoignage.php?message=temoignage_ok");
    exit();
}
?>


<?php
if (isset($_GET['message'])) {
    if ($_GET['message'] == 'ok') {
        echo "<p style='color:green;'>Message envoyé avec succès</p>";
    } elseif ($_GET['message'] == 'existe') {
        echo "<p style='color:red;'>Cet utilisateur est déjà inscrit</p>";
    }
}
?>