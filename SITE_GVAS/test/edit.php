<?php
require __DIR__ . '/admin_auth.php';
require __DIR__ . '/config.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    header('Location: dashboard.php');
    exit;
}

$pdo = db();
$stmt = $pdo->prepare("SELECT * FROM inscriptions WHERE id = ?");
$stmt->execute([$id]);
$r = $stmt->fetch();
if (!$r) {
    http_response_code(404);
    exit('Inscription introuvable.');
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fields = ['nom', 'prenoms', 'sexe', 'date_naissance', 'lieu_naissance', 'nationalite', 'adresse', 'telephone', 'niveau_etudes', 'profession', 'type_formation', 'date_debut', 'urgence_nom', 'urgence_telephone'];
    $data = [];
    foreach ($fields as $f) $data[$f] = trim($_POST[$f] ?? '');

    if (!$data['nom'] || !$data['prenoms'] || !$data['sexe'] || !$data['date_naissance'] || !$data['lieu_naissance'] || !$data['nationalite'] || !$data['adresse'] || !$data['telephone'] || !$data['niveau_etudes'] || !$data['type_formation'] || !$data['date_debut'] || !$data['urgence_nom'] || !$data['urgence_telephone']) {
        $error = 'Veuillez remplir tous les champs obligatoires.';
    } else {
        $stmt = $pdo->prepare("UPDATE inscriptions SET nom=:nom, prenoms=:prenoms, sexe=:sexe, date_naissance=:date_naissance, lieu_naissance=:lieu_naissance, nationalite=:nationalite, adresse=:adresse, telephone=:telephone, niveau_etudes=:niveau_etudes, profession=:profession, type_formation=:type_formation, date_debut=:date_debut, urgence_nom=:urgence_nom, urgence_telephone=:urgence_telephone WHERE id=:id");
        $data[':id'] = $id;
        $stmt->execute([
            ':nom' => $data['nom'],
            ':prenoms' => $data['prenoms'],
            ':sexe' => $data['sexe'],
            ':date_naissance' => $data['date_naissance'],
            ':lieu_naissance' => $data['lieu_naissance'],
            ':nationalite' => $data['nationalite'],
            ':adresse' => $data['adresse'],
            ':telephone' => $data['telephone'],
            ':niveau_etudes' => $data['niveau_etudes'],
            ':profession' => $data['profession'],
            ':type_formation' => $data['type_formation'],
            ':date_debut' => $data['date_debut'],
            ':urgence_nom' => $data['urgence_nom'],
            ':urgence_telephone' => $data['urgence_telephone'],
            ':id' => $id
        ]);
        header("Location: view.php?id=$id");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Modifier | GVAS</title>
    <link rel="stylesheet" href="admin.css">
</head>

<body>
    <main class="admin-wrap">
        <div class="detail-actions"><a class="btn light" href="view.php?id=<?= $id ?>">← Annuler</a></div>
        <section class="panel form-panel">
            <p class="kicker">MODIFICATION</p>
            <h1><?= htmlspecialchars($r['matricule']) ?></h1>
            <?php if ($error): ?><div class="alert error"><?= htmlspecialchars($error) ?></div><?php endif; ?>
            <form method="post" class="edit-grid">
                <?php
                $inputs = [
                    'nom' => 'Nom(s)',
                    'prenoms' => 'Prénom(s)',
                    'lieu_naissance' => 'Lieu de naissance',
                    'nationalite' => 'Nationalité',
                    'adresse' => 'Adresse',
                    'telephone' => 'Téléphone',
                    'profession' => 'Profession',
                    'urgence_nom' => 'Nom urgence',
                    'urgence_telephone' => 'Téléphone urgence'
                ];
                foreach ($inputs as $name => $label):
                ?>
                    <label><?= $label ?><input name="<?= $name ?>" value="<?= htmlspecialchars($r[$name]) ?>" <?= in_array($name, ['nom', 'prenoms', 'lieu_naissance', 'nationalite', 'adresse', 'telephone', 'urgence_nom', 'urgence_telephone']) ? 'required' : '' ?>></label>
                <?php endforeach; ?>
                <label>Sexe<select name="sexe">
                        <option <?= $r['sexe'] === 'Masculin' ? 'selected' : '' ?>>Masculin</option>
                        <option <?= $r['sexe'] === 'Féminin' ? 'selected' : '' ?>>Féminin</option>
                    </select></label>
                <label>Niveau d’études<input name="niveau_etudes" value="<?= htmlspecialchars($r['niveau_etudes']) ?>" required></label>
                <label>Formation<input name="type_formation" value="<?= htmlspecialchars($r['type_formation']) ?>" required></label>
                <label>Date de naissance<input type="date" name="date_naissance" value="<?= htmlspecialchars($r['date_naissance']) ?>" required></label>
                <label>Date de début<input type="date" name="date_debut" value="<?= htmlspecialchars($r['date_debut']) ?>" required></label>
                <div class="edit-submit"><button class="btn primary">Enregistrer les modifications</button></div>
            </form>
        </section>
    </main>
</body>

</html>