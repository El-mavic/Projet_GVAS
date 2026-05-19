<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: admin_log.php");
    exit();
}
require 'traitement.php';

// Statistiques
$totalInscriptions = $pdo->query("SELECT COUNT(*) FROM inscriptions")->fetchColumn();
$totalMessages = $pdo->query("SELECT COUNT(*) FROM utilisateurs")->fetchColumn();
$totalHommes = $pdo->query("SELECT COUNT(*) FROM inscriptions WHERE sexe='Masculin'")->fetchColumn();
$totalFemmes = $pdo->query("SELECT COUNT(*) FROM inscriptions WHERE sexe='Féminin'")->fetchColumn();
$totalTemoignages = $pdo->query("SELECT COUNT(*) FROM temoignages")->fetchColumn();

// Dernières inscriptions
$inscriptions = $pdo->query(
    "SELECT * FROM inscriptions ORDER BY id DESC LIMIT 10"
)->fetchAll(PDO::FETCH_ASSOC);

// Derniers messages
$messages = $pdo->query(
    "SELECT * FROM utilisateurs ORDER BY id DESC LIMIT 5"
)->fetchAll(PDO::FETCH_ASSOC);

// Derniers témoignages
$temoignages = $pdo->query(
    "SELECT * FROM temoignages ORDER BY id ASC LIMIT 10"
)->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard GVAS</title>
    <link rel="stylesheet" href="dashboard.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>

    <div class="dashboard">

        <header>
            <h1>Groupe Vision d'Aigle Services</h1>
            <p>Tableau de bord administratif</p>
            <button id="theme-toggle">🌙 Mode sombre</button>
            <a href="logout.php" class="logout-btn">Déconnexion</a>
        </header>

        <!-- Cartes statistiques -->
        <section class="cards">
            <div class="card">
                <h3>Total Inscriptions</h3>
                <p><?= $totalInscriptions ?></p>
            </div>

            <div class="card">
                <h3>Total Messages</h3>
                <p><?= $totalMessages ?></p>
            </div>

            <div class="card">
                <h3>Hommes</h3>
                <p><?= $totalHommes ?></p>
            </div>

            <div class="card">
                <h3>Femmes</h3>
                <p><?= $totalFemmes ?></p>
            </div>
            <div class="card">
                <h3>Total Témoignages</h3>
                <p><?= $totalTemoignages ?></p>
            </div>
        </section>

        <!-- Graphique -->
        <section class="chart-container">
            <h2>Répartition par sexe</h2>
            <canvas id="myChart"></canvas>
        </section>

<!--Gestion d'impression-->
        <div class="table-header">
            <h2>Dernières inscriptions</h2>
            <button onclick="printSection('inscriptions')" class="print-btn">
                Imprimer
            </button>

        </div>
        <!-- Inscriptions -->
        <div id="inscriptions">
            <section class="table-section">
                <h2>Dernières inscriptions</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Date</th>
                            <th>Sexe</th>
                            <th>Téléphone</th>
                            <th>Quartier</th>
                            <th>Formation</th>
                            <th>Action</th>
                        </tr>
                    </thead>
        
        <tbody>
            <?php foreach ($inscriptions as $inscription): ?>
                <tr>
                    <td><?= htmlspecialchars($inscription['nom']) ?></td>
                    <td><?= htmlspecialchars($inscription['prenom']) ?></td>
                    <td><?= htmlspecialchars($inscription['date']) ?></td>
                    <td><?= htmlspecialchars($inscription['sexe']) ?></td>
                    <td><?= htmlspecialchars($inscription['telephone']) ?></td>
                    <td><?= htmlspecialchars($inscription['quartier']) ?></td>
                    <td><?= htmlspecialchars($inscription['formation']) ?></td>
                    <td>
                        <a href="delete.php?id=<?= $inscription['id'] ?>&type=inscription"
                            class="delete-btn"
                            onclick="return confirm('Supprimer cette inscription ?')">
                            Supprimer
                        </a>

                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        </table>
        </section>
</div>
        <!-- Messages -->
        <section class="table-section">
            <h2>Messages reçus</h2>
            <table>
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Sujet</th>
                        <th>Message</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($messages as $msg): ?>
                        <tr>
                            <td><?= htmlspecialchars($msg['nom']) ?></td>
                            <td><?= htmlspecialchars($msg['email']) ?></td>
                            <td><?= htmlspecialchars($msg['sujet']) ?></td>
                            <td><?= htmlspecialchars($msg['message']) ?></td>
                            <td>
                                <a href="delete.php?id=<?= $msg['id'] ?>&type=contact"
                                    class="delete-btn"
                                    onclick="return confirm('Supprimer ce message ?')">
                                    Supprimer
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    </div>
    <section class="table-section">
        <h2>Témoignages reçus</h2>

        <table>
            <thead>
                <tr>
                    <th>N°</th>
                    <th>Nom(s)</th>
                    <th>Témoignage</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($temoignages as $tem): ?>
                    <tr>
                        <td><?= htmlspecialchars($tem['id']) ?></td>
                        <td><?= htmlspecialchars($tem['nom']) ?></td>
                        <td><?= htmlspecialchars($tem['message']) ?></td>
                        <td>
                            <a href="delete.php?id=<?= $tem['id'] ?>&type=temoignage"
                                class="delete-btn"
                                onclick="return confirm('Supprimer ce témoignage ?')">
                                Supprimer
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
    <script>
        const ctx = document.getElementById('myChart');

        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Hommes', 'Femmes'],
                datasets: [{
                    data: [<?= $totalHommes ?>, <?= $totalFemmes ?>],
                    backgroundColor: ['#2563eb', '#ec4899'],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    </script>
    <script>
        const toggleBtn = document.getElementById('theme-toggle');

        toggleBtn.addEventListener('click', () => {
            document.body.classList.toggle('dark-mode');

            if (document.body.classList.contains('dark-mode')) {
                toggleBtn.textContent = '☀️ Mode clair';
            } else {
                toggleBtn.textContent = '🌙 Mode sombre';
            }
        });
    </script>
    <script>
        function printSection(sectionId) {
            const content = document.getElementById(sectionId).innerHTML;

            const printWindow = window.open('', '', 'width=900,height=700');

            printWindow.document.write(`
        <html>
        <head>
            <title>Impression</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    padding: 20px;
                }

                table {
                    width: 100%;
                    border-collapse: collapse;
                }

                th, td {
                    border: 1px solid #000;
                    padding: 10px;
                    text-align: left;
                }

                th {
                    background: #f1f5f9;
                }
            </style>
        </head>
        <body>
            ${content}
        </body>
        </html>
    `);
            printWindow.document.close();
            printWindow.print();
        }
    </script>
</body>

</html>