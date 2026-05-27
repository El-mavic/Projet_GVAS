<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: admin_log.php");
    exit();
}

require 'traitement.php';

/* Inscriptions supprimées */
$inscriptions = $pdo->query(
    "SELECT * FROM inscriptions 
     WHERE deleted = 1
     ORDER BY id DESC"
)->fetchAll(PDO::FETCH_ASSOC);

/* Messages supprimés */
$messages = $pdo->query(
    "SELECT * FROM utilisateurs 
     WHERE deleted = 1
     ORDER BY id DESC"
)->fetchAll(PDO::FETCH_ASSOC);

/* Témoignages supprimés */
$temoignages = $pdo->query(
    "SELECT * FROM temoignages 
     WHERE deleted = 1
     ORDER BY id DESC"
)->fetchAll(PDO::FETCH_ASSOC);

/* Abonnements supprimés */
$abonnements = $pdo->query(
    "SELECT * FROM abonnements
     WHERE deleted = 1
     ORDER BY id DESC"
)->fetchAll(PDO::FETCH_ASSOC);
?>
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Corbeille</title>
    <link rel="stylesheet" href="dashboard.css">
    <link rel="icon" href="images/Images/GVAS.png">
    <title>Corbeille - GVAS</title>
</head>

<body>

    <header class="topbar">

        <div class="logo">
            <h2>Groupe Vision d'Aigle Services</h2>
        </div>

        <nav class="navbar">
            <a href="dashboard.php" class="logou">Tableau de bord</a>
            <a href="logout.php" class="logout">Déconnexion</a>
        </nav>

    </header>
    <!-- Inscriptions -->
    <section class="table-section">
        <h2>Inscriptions supprimées</h2>

        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Formation</th>
                    <th>Supprimé le</th>
                    <th>Action</th>
                    <th>Delete</th>
                </tr>
            </thead>

            <tbody>

                <?php foreach ($inscriptions as $item): ?>

                    <tr>
                        <td><?= htmlspecialchars($item['nom']) ?></td>
                        <td><?= htmlspecialchars($item['prenom']) ?></td>
                        <td><?= htmlspecialchars($item['formation']) ?></td>
                        <td>
                            <?= !empty($item['deleted_at'])
                                ? date('d/m/Y H:i', strtotime($item['deleted_at']))
                                : 'Date indisponible' ?>
                        </td>
                        <td>
                            <a href="restore.php?id=<?= $item['id'] ?>&type=inscription">
                                Restaurer
                            </a>

                        </td>
                        <td>
                            <a href="delete.php?id=<?= $item['id'] ?>&type=inscription"
                                class="delete-btn"
                                onclick="return confirm('Supprimer cette inscription définitivement ?')">
                                Delete
                            </a>
                        </td>
                    </tr>

                <?php endforeach; ?>

            </tbody>
        </table>
    </section>

    <!-- Messages -->
    <section class="table-section">
        <h2>Messages supprimés</h2>

        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Supprimé le</th>
                    <th>Action</th>
                    <th>Delete</th>
                </tr>
            </thead>

            <tbody>

                <?php foreach ($messages as $msg): ?>

                    <tr>

                        <td><?= htmlspecialchars($msg['nom']) ?></td>
                        <td><?= htmlspecialchars($msg['email']) ?></td>
                        <td><?= htmlspecialchars($msg['message']) ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($msg['deleted_at'])) ?></td>

                        <td>
                            <a href="restore.php?id=<?= $msg['id'] ?>&type=contact">
                                Restaurer
                            </a>
                        </td>
                        <td>
                            <a href="delete.php?id=<?= $msg['id'] ?>&type=contact"
                                class="delete-btn"
                                onclick="return confirm('Supprimer ce message définitivement ?')">
                                Delete
                            </a>
                        </td>
                    </tr>

                <?php endforeach; ?>

            </tbody>
        </table>
    </section>

    <!-- Témoignages -->
    <section class="table-section">

        <h2>Témoignages supprimés</h2>

        <table>

            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Témoignage</th>
                    <th>Supprimé le</th>
                    <th>Action</th>
                    <th>Delete</th>
                </tr>
            </thead>

            <tbody>

                <?php foreach ($temoignages as $tem): ?>
                    <tr>
                        <td><?= htmlspecialchars($tem['nom']) ?></td>
                        <td><?= htmlspecialchars($tem['message']) ?></td>
                        <td>
                            <?= !empty($tem['deleted_at'])
                                ? date('d/m/Y H:i', strtotime($tem['deleted_at']))
                                : 'Date indisponible' ?>
                        </td>

                        <td>

                            <a href="restore.php?id=<?= $tem['id'] ?>&type=temoignage">
                                Restaurer
                            </a>

                        </td>
                        <td>
                            <a href="delete.php?id=<?= $tem['id'] ?>&type=temoignage"
                                class="delete-btn"
                                onclick="return confirm('Supprimer ce témoignage définitivement ?')">
                                Delete
                            </a>
                        </td>
                    </tr>

                <?php endforeach; ?>

            </tbody>

        </table>

    </section>
    <section class="table-section">
        <h2>Abonnements</h2>

        <table>
            <thead>
                <tr>
                    <th>N°</th>
                    <th>Email</th>
                    <th>Date d'abonnement</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($abonnements as $abo): ?>
                    <tr>
                        <td><?= htmlspecialchars($abo['id']) ?></td>
                        <td><?= htmlspecialchars($abo['email']) ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($abo['date_abonnement'])) ?></td>
                        <td>
                            <a href="delete.php?id=<?= $abo['id'] ?>&type=abonnement"
                                class="delete-btn"
                                onclick="return confirm('Supprimer cet abonnement ?')">
                                Delete
                            </a>
                        </td>

                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
    </div>
    <style>
        /* RESET */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            background: #f4f7fb;
            color: #333;
        }

        /* HEADER */
        .topbar {
            width: 100%;
            background: #0f172a;
            color: white;
            padding: 15px 40px;

            display: flex;
            justify-content: space-between;
            align-items: center;

            position: sticky;
            top: 0;
            z-index: 1000;

            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .logo h2 {
            font-size: 24px;
        }

        /* NAVBAR */
        .navbar {
            display: flex;
            gap: 20px;
        }

        .navbar a {
            text-decoration: none;
            color: white;
            padding: 10px 18px;
            border-radius: 8px;
            transition: 0.3s;
            font-weight: bold;
        }

        .navbar a:hover {
            background: #1e293b;
        }

        .logou {
            background: green;
        }

        .logout {
            background: #dc2626;
        }

        .logout:hover {
            background: #b91c1c;
        }

        /* DASHBOARD */
        .dashboard {
            padding: 30px;
        }

        /* TITRES */
        h1 {
            margin-bottom: 20px;
            color: #0f172a;
        }

        .table-section {
            margin-top: 40px;
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .table-section h2 {
            margin-bottom: 20px;
            color: #1e293b;
        }

        /* TABLE */
        table {
            width: 100%;
            border-collapse: collapse;
            overflow: hidden;
        }

        thead {
            background: #0f172a;
            color: white;
        }

        th,
        td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        tbody tr {
            transition: 0.3s;
        }

        tbody tr:hover {
            background: #f1f5f9;
        }

        /* BOUTONS */
        td a {
            display: inline-block;
            text-decoration: none;
            background: #2563eb;
            color: white;
            padding: 10px 16px;
            border-radius: 8px;
            transition: 0.3s;
            font-size: 14px;
            font-weight: bold;
        }

        td a:hover {
            background: #1d4ed8;
            transform: translateY(-2px);
        }

        /* RETOUR */
        .dashboard>a {
            display: inline-block;
            margin-top: 10px;
            text-decoration: none;
            background: #0f172a;
            color: white;
            padding: 12px 18px;
            border-radius: 8px;
            transition: 0.3s;
        }

        .dashboard>a:hover {
            background: #1e293b;
        }

        /* RESPONSIVE */
        @media(max-width:900px) {

            .topbar {
                flex-direction: column;
                gap: 15px;
                padding: 20px;
            }

            .navbar {
                flex-wrap: wrap;
                justify-content: center;
            }

            .dashboard {
                padding: 15px;
            }

            .table-section {
                overflow-x: auto;
            }

            table {
                min-width: 700px;
            }
        }

        @media(max-width:500px) {

            .logo h2 {
                font-size: 20px;
            }

            .navbar a {
                width: 100%;
                text-align: center;
            }

            td a {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</body>

</html>