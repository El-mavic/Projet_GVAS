<?php
require __DIR__ . '/admin_auth.php';
require __DIR__ . '/config.php';

$pdo = db();
$q = trim($_GET['q'] ?? '');
$formation = trim($_GET['formation'] ?? '');

$where = [];
$params = [];

if ($q !== '') {
    $where[] = "(nom LIKE :q OR prenoms LIKE :q OR matricule LIKE :q OR telephone LIKE :q)";
    $params[':q'] = "%$q%";
}
if ($formation !== '') {
    $where[] = "type_formation = :formation";
    $params[':formation'] = $formation;
}

$sql = "SELECT * FROM inscriptions";
if ($where) $sql .= " WHERE " . implode(" AND ", $where);
$sql .= " ORDER BY created_at DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$rows = $stmt->fetchAll();

$total = (int)$pdo->query("SELECT COUNT(*) FROM inscriptions")->fetchColumn();
$today = (int)$pdo->query("SELECT COUNT(*) FROM inscriptions WHERE DATE(created_at)=CURDATE()")->fetchColumn();
$formations = $pdo->query("SELECT DISTINCT type_formation FROM inscriptions ORDER BY type_formation")->fetchAll(PDO::FETCH_COLUMN);
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Dashboard GVAS</title>
    <link rel="stylesheet" href="admin.css">
</head>

<body>
    <header class="admin-top">
        <div class="brand"><span class="mini-logo">GVAS</span>
            <div><small>Administration</small></div>
        </div>
        <div class="top-actions"><a href="logout.php">Déconnexion</a></div>
    </header>

    <main class="admin-wrap">
        <div class="page-heading">
            <div>
                <p class="kicker">TABLEAU DE BORD</p>
                <h1>Inscriptions</h1>
                <p class="muted">Gestion des participants au Programme.</p>
            </div>
            <a class="btn primary" href="index.php">+ Nouvelle inscription</a>
        </div>

        <section class="stats">
            <div class="stat"><span>Total inscrits</span><strong><?= $total ?></strong></div>
            <div class="stat"><span>Inscrits aujourd'hui</span><strong><?= $today ?></strong></div>
            <div class="stat"><span>Formations</span><strong><?= count($formations) ?></strong></div>
        </section>

        <section class="panel">
            <form class="filters" method="get">
                <input name="q" value="<?= htmlspecialchars($q) ?>" placeholder="Rechercher nom, matricule, téléphone...">
                <select name="formation">
                    <option value="">Toutes les formations</option>
                    <?php foreach ($formations as $f): ?>
                        <option <?= $formation === $f ? 'selected' : '' ?>><?= htmlspecialchars($f) ?></option>
                    <?php endforeach; ?>
                </select>
                <button class="btn primary">Rechercher</button>
                <?php if ($q || $formation): ?><a class="btn light" href="dashboard.php">Effacer</a><?php endif; ?>

                <a class="btn export" href="export.php?<?= http_build_query($_GET) ?>">Exporter Excel</a>
            </form>

            <div class="table-scroll">
                <table>
                    <thead>
                        <tr>
                            <th>Photo</th>
                            <th>Matricule</th>
                            <th>Participant</th>
                            <th>Téléphone</th>
                            <th>Formation</th>
                            <th>Niveau</th>
                            <th>Date d'inscription</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!$rows): ?>
                            <tr>
                                <td colspan="8" class="empty">Aucune inscription trouvée.</td>
                            </tr>
                        <?php endif; ?>
                        <?php foreach ($rows as $r): ?>
                            <tr>
                                <td>
                                    <?php if ($r['photo'] && is_file(__DIR__ . '/uploads/' . $r['photo'])): ?>
                                        <img class="avatar" src="uploads/<?= htmlspecialchars($r['photo']) ?>" alt="">
                                    <?php else: ?><span class="avatar placeholder">GV</span><?php endif; ?>
                                </td>
                                <td><strong><?= htmlspecialchars($r['matricule']) ?></strong></td>
                                <td><?= htmlspecialchars($r['nom'] . ' ' . $r['prenoms']) ?></td>
                                <td><?= htmlspecialchars($r['telephone']) ?></td>
                                <td><?= htmlspecialchars($r['type_formation']) ?></td>
                                <td><?= htmlspecialchars($r['niveau_etudes']) ?></td>
                                <td><?= date('d/m/Y H:i', strtotime($r['created_at'])) ?></td>
                                <td class="actions">
                                    <a href="view.php?id=<?= (int)$r['id'] ?>">Voir</a>
                                    <a href="edit.php?id=<?= (int)$r['id'] ?>">Modifier</a>
                                    <a class="danger-link" href="delete.php?id=<?= (int)$r['id'] ?>" onclick="return confirm('Supprimer définitivement cette inscription ?')">Supprimer</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</body>

</html>