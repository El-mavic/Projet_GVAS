<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Groupe Vision d'Aigle Services</title>
    <link rel="stylesheet" href="formation.css">
</head>

<body>


    <header class="header" id="header">
        <a href="#home" class="logo-container">
            <div class="logo">
                <img class="gvas" src="images/Images/GVAS.png" alt="GVAS">
            </div>
            <div class="logo-text">roupe Vision d'Aigle Services</div>
        </a>

        <div class="buttons">
            <a class="action-button pro" href="index.php">Inscription</a>

        </div>

    </header>

    <!-- SECTION -->




    <!-- GRID DES FORMATIONS -->
    <section class="formations">

        <div class="card">
            <img src="images/Formation/2.jpg" alt="Informatique Bureautique">
            <div class="text-hover">L'INFORMATIQUE BUREAUTIQUE</div>
            <h3>INFORMATIQUE</h3>
            <p>Initiation à l'informatique<br>Word, Excel, PowerPoint...</p>
        </div>

        <div class="card">
            <img src="images/Formation/3.jpg" alt="La langue Anglaise">
            <div class="text-hover">LA LANGUE ANGLAISE</div>
            <h3>ANGLAIS</h3>
            <p>Général, Professionnel<br>Traduction, interprétariat</p>
        </div>

        <div class="card">
            <img src="images/Formation/4.jpg" alt="Logistique">
            <div class="text-hover">LOGISTIQUE</div>
            <h3>LOGISTIQUE</h3>
            <p>Gestion de stock<br>Magasinage</p>
        </div>

    </section>
    <section class="formations">

        <div class="card">
            <img src="images/Formation/5.jpg" alt="Reseau informatique">
            <div class="text-hover">RESEAU INFORMATIQUE</div>
            <h3>RESEAU INFORMATIQUE</h3>
            <p>Installation, maintenance, sécurité</p>
        </div>

        <div class="card">
            <img src="images/Formation/6.jpg" alt="La maintenance des ordinateurs">
            <div class="text-hover">LA MAINTENANCE DES ORDINATEURS</div>
            <h3>LA MAINTENANCE DES ORDINATEURS</h3>
            <p>Assurez le bon fonctionnement et la longévité<br> de vos ordinateurs</p>
        </div>

        <div class="card">
            <img src="images/Formation/7.jpg" alt="La Comptabilité">
            <div class="text-hover">LA COMPTABILITE</div>
            <h3>COMPTABILITE</h3>
            <p>Maîtrisez la gestion comptable et <br>le suivi financier de votre entreprise</p>
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