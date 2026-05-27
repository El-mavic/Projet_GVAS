<?php
session_start();
require 'traitement.php';

$page = pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME);

if (!isset($_SESSION['visite_' . $page])) {

    $stmt = $pdo->prepare("INSERT INTO visites (page) VALUES (?)");
    $stmt->execute([$page]);

    $_SESSION['visite_' . $page] = true;
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/Images/GVAS.png">
    <title>Groupe Vision d'Aigle Services</title>
    <link rel="stylesheet" href="formation.css">
</head>

<body>


    <header class="header" id="header">
        <a href="index.php" class="logo-container">
            <div class="logo">
                <img class="gvas" src="images/Images/GVAS.png" alt="GVAS">
            </div>
            <div class="logo-text">roupe Vision d'Aigle Services</div>
        </a>

        <div class="buttons">
            <a class="action-button1" href="temoignage.php">En savoir plus</a>
            <a class="action-button pro" href="index.php">Inscription</a>
        </div>

    </header>

    <!-- SECTION -->

    <!-- GRID DES FORMATIONS -->
    <section class="formations">

        <div class="card">
            <img src="images/Formation/2.jpg" alt="Informatique Bureautique">
            <div class="text-hover">Inscription: 5000 FCA<br>Frais Mensuels: 10000 FCA<br>Durée: 6 mois</div>
            <h3>INFORMATIQUE</h3>
            <p>Initiation à l'informatique<br>Word, Excel, PowerPoint...</p>
        </div>

        <div class="card">
            <img src="images/Formation/3.jpg" alt="La langue Anglaise">
            <div class="text-hover">Inscription: 5000 FCA<br>Frais Mensuels: 10000 FCA<br>Durée: 6 mois</div>
            <h3>ANGLAIS</h3>
            <p>Général, Professionnel<br>Traduction, interprétariat</p>
        </div>

        <div class="card">
            <img src="images/Formation/4.jpg" alt="Logistique">
            <div class="text-hover">Inscription: 5000 FCA<br>Frais Mensuels: 10000 FCA<br>Durée: 6 mois</div>
            <h3>LOGISTIQUE</h3>
            <p>Gestion de stock<br>Magasinage</p>
        </div>

    </section>
    <section class="formations">

        <div class="card">
            <img src="images/Formation/5.jpg" alt="Reseau informatique">
            <div class="text-hover">Inscription: 5000 FCA<br>Frais Mensuels: 10000 FCA<br>Durée: 6 mois</div>
            <h3>RESEAU INFORMATIQUE</h3>
            <p>Installation, maintenance, sécurité</p>
        </div>

        <div class="card">
            <img src="images/Formation/6.jpg" alt="La maintenance des ordinateurs">
            <div class="text-hover">Inscription: 5000 FCA<br>Frais Mensuels: 10000 FCA<br>Durée: 6 mois</div>
            <h3>LA MAINTENANCE DES ORDINATEURS</h3>
            <p>Assurez le bon fonctionnement et la longévité<br> de vos ordinateurs</p>
        </div>

        <div class="card">
            <img src="images/Formation/7.jpg" alt="La Comptabilité">
            <div class="text-hover">Inscription: 5000 FCA<br>Frais Mensuels: 10000 FCA<br>Durée: 6 mois</div>
            <h3>COMPTABILITE</h3>
            <p>Maîtrisez la gestion comptable et <br>le suivi financier de votre entreprise</p>
        </div>

        <div class="card">
            <img src="images/Formation/8.jpg" alt="QHSE">
            <div class="text-hover">Inscription: 5000 FCA<br>Frais Mensuels: 10000 FCA<br>Durée: 6 mois</div>
            <h3>QHSE</h3>
            <p>Formation QHSE très enrichissante, je recommande.</p>
        </div>

        <div class="card">
            <img src="images/Formation/9.jpg" alt="Assistanat">
            <div class="text-hover">Inscription: 5000 FCA<br>Frais Mensuels: 10000 FCA<br>Durée: 6 mois</div>
            <h3>ASSISTANAT BUREAUTIQUE</h3>
            <p>Formation très utile et pratique.</p>
        </div>

        <div class="card">
            <img src="images/Formation/10.jpg" alt="Entreprenariat">
            <div class="text-hover">Inscription: 5000 FCA<br>Frais Mensuels: 10000 FCA<br>Durée: 6 mois</div>
            <h3>ENTREPRENARIAT</h3>
            <p>Formation utile pour lancer son projet.</p>
        </div>
    </section>
    <script>
        let lastScroll = 0;
        const header = document.getElementById("header");

        window.addEventListener("scroll", () => {
            let currentScroll = window.pageYOffset;

            if (currentScroll > lastScroll) {
                // scroll vers le bas → cacher
                header.classList.add("hide");
            } else {
                // scroll vers le haut → afficher
                header.classList.remove("hide");
            }


            lastScroll = currentScroll;
        });
    </script>

</body>

</html>