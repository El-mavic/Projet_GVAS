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
    <meta name="description"
        content="De réfférence, GVAS est une structure 
          professionnelle composée d’un personnel de qualité agréé 
          par l’État. spécialisé dans la vente des produits et services, 
          l'accompagnement professionnelle à travers des formations qualifiantes
           et certifiantes mais aussi
           dans un suivi quelconque en vue d’un domaine professionnel donné.">
    <meta name="author" content="Mr El-mavic BAKALA">
    <meta name="author" content="Miss Célina LUEMBA">
    <meta name="author" content="Gln93/Mr Tokyo">
    <meta name="robots" content="index, follow">
    <meta name="keywords" content="GVAS, EVGS, groupe vision d'aigle services, vision d'aigle, achat, formation, cours en ligne, produits, service">
    <link rel="icon" href="images/Images/GVAS.png">
    <title>Groupe Vision d'Aigle Services</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="formation.css">
    <link rel="stylesheet" href="style.css">
</head>

<body class="anime">
    <div class=" burger-menu ">
        <ul class=" links">
            <li><a href="index.php">Accueil</a></li>
            <li><a href="temoignage.php">Temoignage</a></li>
            <li><a href="Galerie.php">Galerie</a></li>
            <li><a href="contacts.php">Contacts</a></li>
            <div class="divider"></div>
            <div class="buttons-burger-menu">
                <a class="action-button" href="Gloire/page_publicitaire.php">Pub</a>
                <a class="action-button" href="vivi/apropos.php">A propos</a>
            </div>
        </ul>
    </div>
    <header>

        <div class="navbar">
            <div class="logo">
                <img class="gvas" src="images/Images/GVAS.png" alt="GVAS">

            </div>

            <ul class="links">
                <li><a href="index.php">Accueil</a></li>
                <li><a href="temoignage.php">Temoignage</a></li>
                <li><a href="galerie.php">Galerie</a></li>
                <li><a href="contacts.php">Contacts</a></li>
            </ul>
            <div class="buttons">
                <a class="action-button pro " href="Gloire/page_publicitaire.php">Pub</a>
                <a class="action-button" href="vivi/apropos.php">A propos</a>
            </div>
            <div class="burger-menu-button">
                <i class="fa-solid fa-bars"></i>
            </div>
        </div>
    </header>
    <p class="texte">Groupe Vision d'Aigle Services </p>



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
    
    <!--burgerMenuButton-->
    <script>
        const burgerMenuButton = document.querySelector('.burger-menu-button');
        const burgerMenuButtonIcon = document.querySelector('.burger-menu-button i');
        const burgerMenu = document.querySelector('.burger-menu');

        burgerMenuButton.onclick = function(e) {
            e.stopPropagation();

            burgerMenu.classList.toggle('open');

            const isOpen = burgerMenu.classList.contains('open');

            burgerMenuButtonIcon.classList = isOpen ?
                'fa-solid fa-xmark' :
                'fa-solid fa-bars';
        };

        /* fermer si on clique à côté */
        document.addEventListener('click', function(e) {
            if (
                !burgerMenu.contains(e.target) &&
                !burgerMenuButton.contains(e.target)
            ) {
                burgerMenu.classList.remove('open');
                burgerMenuButtonIcon.classList = 'fa-solid fa-bars';
            }
        });

        /* empêcher fermeture si clic dans le menu */
        burgerMenu.addEventListener('click', function(e) {
            e.stopPropagation();
        });
    </script>
</body>

</html>