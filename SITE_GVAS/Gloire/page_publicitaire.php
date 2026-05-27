<?php
session_start();
require '../traitement.php';

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
    <link rel="stylesheet" href="Assets/Css/style.css">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="Assets/Img/icon_logo/logo-GVAS.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="Assets/Css/stilisation.css">
    <title>Page Publicitaire</title>
</head>

<body>
    <header>
        <!-- **************header************** -->
        <section class="flouter">
            <div class="section_navbar">
                <div class="Partie_logo">
                    <div id="sous_class_contact">
                        <div class="a">
                            <a href="../index.php">
                                <i class="fa-solid fa-house" style="color: rgb(0, 0, 0);"></i>
                            </a>
                        </div>

                        <div class="a">
                            <a href="https://www.facebook.com/profile.php?id=61583138888176" target="_blank">
                                <i class="fa-brands fa-square-facebook" style="color: rgb(0, 0, 0);"></i>
                            </a>
                        </div>

                        <div class="a">
                            <a href="#">
                                <i class="fa-brands fa-youtube" style="color: rgb(0, 0, 0);"></i>
                            </a>
                        </div>

                        <div class="a">
                            <a href="https://wa.me/242064201415" target="_blank">
                                <i class="fa-brands fa-whatsapp" style="color: rgb(0, 0, 0);"></i>
                            </a>
                        </div>
                    </div>

                    <div class="sous_class_logo">
                        <img src="Assets/Img/icon_logo/logo-GVAS.png" alt="logo-GVAS">
                        <h1>GROUPE VISION D'AIGLE SERVICES</h1>
                    </div>

                    <div class="contacter">
                        <a href="../Formation.php">Formations</a>
                    </div>

                    <div class="burger" id="burger">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>

                <div class="partie_navbar">
                    <div>
                        <nav id="menu">
                            <ul>
                                <li><a href="../index.php">Acceuil</a></li>
                                <li><a href="../Vivi/apropos.html">A-propos</a></li>
                                <li><a href="../contacts.php">Contacts</a></li>
                                <li><a href="../galerie.php">Galerie</a></li>
                                <li><a href="../Formation.php">Formations</a></li>
                            </ul>
                        </nav>
                    </div>

                </div>
            </div>
        </section>

        <!--******ruban déroulant********-->
        <section class="section_pub">
            <div class="ad-banner">
                <div class="ad-track">
                    <!-- Contenu répété pour effet infini -->
                    <div class="baba1" class="ad-item">#Service de Livraison</div>
                    <div class="baba2" class="ad-item">#Paiement sécurisé</div>

                    <!-- DUPLICATION (important pour boucle fluide) -->
                    <div class="baba3" class="ad-item">#Formation professionnels</div>
                    <div class="baba4" class="ad-item">#Promo vacances</div>
                    <div class="baba5" class="ad-item">#Service d'orientation inclu</div>
                    <div class="baba6" class="ad-item">#Vente d'articles</div>
                </div>
            </div>
        </section>
    </header>

    <main id="ancre">
        <section id="classeur">
            <div class="classe">
                <div class="defilements">
                </div>

                <div class="rondeurs">
                    <div class="contien">

                        <!-- ABONNEMENT -->
                        <button class="subscribe-btn" id="subscribeBtn">
                            Abonnez-vous
                        </button>

                        <!-- PARTAGE -->
                        <button class="share-btn" id="shareBtn">
                            Partager
                        </button>

                    </div>

                    <div>
                        <h1>
                            nombre d'abonnée : XXXX
                        </h1>
                    </div>

                    <!-- POPUP -->

                    <div class="popup" id="popup">
                        <form action="">

                            <div class="popup-top pap">
                                <label class="pap" for="email">Abonnement</label>

                                <span class="close " id="closePopup">
                                    ✖
                                </span>
                            </div>

                            <input class="up_top" type="email" name="email" id="email"
                                placeholder="Entrez votre adresse mail" required>

                            <input class="down_bottom" type="submit" value="Valider" id="valider">
                            </input>
                        </form>
                    </div>



                </div>
            </div>
        </section>

        <div class="parie_publicitaire">
            <h1>DECOUVREZ NOS ARTICLES</h1>
        </div>
        <!-- Fenêtre -->
        <div id="fenetre" class="modal">
            <div class="contenu">
                <span class="fermer" onclick="fermer()">&times;</span>
                <p>Information pour votre inscription</p>
            </div>
        </div>

        <style>
            .modal {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.5);
            }

            .contenu {
                background: white;
                width: 300px;
                margin: 15% auto;
                padding: 20px;
                border-radius: 10px;
                text-align: center;
            }

            .fermer {
                float: right;
                cursor: pointer;
                font-size: 20px;
            }

            .haut a button {
                background-color: none;
            }
        </style>

        <script>
            function changerContenu(section) {

                let contenu = document.getElementById("contenu");

                if (section === "Produits") {
                    contenu.innerHTML = `
            <div class="produits">
                <div class="list_produits">
                    <div class="part">
                        <div class="div">
                             <img src="Assets/Img/img pub./Articles informatiques/19de124bdfd877c8cabdef3183f927e7.jpg" alt="">
                        </div>
                        <div class="dav">
                            <h1>DESCRIPTION</h1>
                            <h2>Ordinateur Bureautique</h2>
                            <p>
                                loremjioji <br>
                                loremjioji <br>
                                loremjioji <br>
                                loremjioji <br>
                            </p>
                                <h3>Prix unitaire : 1 500Frs </h3>
                        </div>
                    </div>

                    <div class="part">
                        <div class="div">
                            <img src="Assets/Img/img pub/Articles informatiques/614rYXY6wAL._AC_.jpg" alt="">
                        </div>

                        <div class="dav">
                            <h1>DESCRIPTION</h1>
                            <h2>Ordinateur Bureautique</h2>
                            <p>
                                loremjioji <br>
                                loremjioji <br>
                                loremjioji <br>
                                loremjioji <br>
                            </p>
                                <h3>Prix unitaire : 1 500Frs </h3>
                        </div>
                    </div>

                    <div class="part">
                        <div class="div">
                            <img src="Assets/Img/img pub/Articles informatiques/OIP (1).webp" alt="">
                        </div>

                        <div class="dav">
                            <h1>DESCRIPTION</h1>
                            <h2>Ordinateur Bureautique</h2>
                            <p>
                                loremjioji <br>
                                loremjioji <br>
                                loremjioji <br>
                                loremjioji <br>
                            </p>
                                <h3>Prix unitaire : 1 500Frs </h3>
                        </div>
                    </div>

                    <div class="part">
                        <div class="div">
                           <img src="Assets/Img/img pub/Articles informatiques/Agrafeuse portable zéro effort, pince agrafeuse, Noir.jpg" alt="">   
                        </div>

                        <div class="dav">
                            <h1>DESCRIPTION</h1>
                            <h2>Ordinateur Bureautique</h2>
                            <p>
                                loremjioji <br>
                                loremjioji <br>
                                loremjioji <br>
                                loremjioji <br>
                            </p>
                                <h3>Prix unitaire : 1 500Frs </h3>
                        </div>
                    </div>

                    <div class="part">
                        <div class="div">
                           <img src="Assets/Img/img pub/Articles informatiques/24236c876fc8c07c6e30deacba065166.jpg" alt="">
                        </div>

                        <div class="dav">
                            <h1>DESCRIPTION</h1>
                            <h2>Ordinateur Bureautique</h2>
                            <p>
                                loremjioji <br>
                                loremjioji <br>
                                loremjioji <br>
                                loremjioji <br>
                            </p>
                                <h3>Prix unitaire : 1 500Frs </h3>
                        </div>
                    </div>

                    
                    <div class="part">
                        <div class="div">
                           <img src="Assets/Img/img pub/Articles informatiques/30x-zoom-5mp-ptz-camra-de-surveillance-wifi-extrieure-ctronics-camra-ip-1-2048x2048 (1).jpg"
                            alt="">
                        </div>

                        <div class="dav">
                            <h1>DESCRIPTION</h1>
                            <h2>Ordinateur Bureautique</h2>
                            <p>
                                loremjioji <br>
                                loremjioji <br>
                                loremjioji <br>
                                loremjioji <br>
                            </p>
                                <h3>Prix unitaire : 1 500Frs </h3>
                        </div>
                    </div>

                    <div class="part">
                        <div class="div">
                           <img src="Assets/Img/img pub/Articles informatiques/30x-zoom-5mp-ptz-camra-de-surveillance-wifi-extrieure-ctronics-camra-ip-1-2048x2048.jpg"
                            alt="">
                        </div>

                        <div class="dav">
                            <h1>DESCRIPTION</h1>
                            <h2>Ordinateur Bureautique</h2>
                            <p>
                                loremjioji <br>
                                loremjioji <br>
                                loremjioji <br>
                                loremjioji <br>
                            </p>
                                <h3>Prix unitaire : 1 500Frs </h3>
                        </div>
                        
                    </div>

                    <div class="part">
                        <div class="div">
                            <img src="Assets/Img/img pub/Articles informatiques/48bf87a5288f4d1e28105fedca1cf4ea.jpg" alt="">
                        </div>

                        <div class="dav">
                            <h1>DESCRIPTION</h1>
                            <h2>Ordinateur Bureautique</h2>
                            <p>
                                loremjioji <br>
                                loremjioji <br>
                                loremjioji <br>
                                loremjioji <br>
                            </p>
                                <h3>Prix unitaire : 1 500Frs </h3>
                        </div>
                    </div>

                    <div class="part">
                        <div class="div">
                            <img src="Assets/Img/img pub/Articles informatiques/61Hj816MJHL._SL1200_.jpg" alt="">
                        </div>

                        <div class="dav">
                            <h1>DESCRIPTION</h1>
                            <h2>Ordinateur Bureautique</h2>
                            <p>
                                loremjioji <br>
                                loremjioji <br>
                                loremjioji <br>
                                loremjioji <br>
                            </p>
                                <h3>Prix unitaire : 1 500Frs </h3>
                        </div>
                    </div>

                    <div class="part">
                        <div class="div">
                            <img src="Assets/Img/img pub/Articles informatiques/7ef4402124e58d6aaa57a56a65734f0b.jpg" alt="">
                        </div>

                        <div class="dav">
                            <h1>DESCRIPTION</h1>
                            <h2>Ordinateur Bureautique</h2>
                            <p>
                                loremjioji <br>
                                loremjioji <br>
                                loremjioji <br>
                                loremjioji <br>
                            </p>
                                <h3>Prix unitaire : 1 500Frs </h3>
                        </div>
                    </div>

                    <div class="part">
                        <div class="div">
                            <img src="Assets/Img/img pub/Articles informatiques/885cc0bda389a60dc37e3b9a6a62a024.jpg" alt="">
                        </div>

                        <div class="dav">
                            <h1>DESCRIPTION</h1>
                            <h2>Ordinateur Bureautique</h2>
                            <p>
                                loremjioji <br>
                                loremjioji <br>
                                loremjioji <br>
                                loremjioji <br>
                            </p>
                                <h3>Prix unitaire : 1 500Frs </h3>
                        </div>
                    </div>

                    <div class="part">
                        <div class="div">
                           <img src="Assets/Img/img pub/Articles informatiques/8e74957870f7946e4c3a7a6af91b1f76.jpg" alt="">
                        </div>

                        <div class="dav">
                            <h1>DESCRIPTION</h1>
                            <h2>Ordinateur Bureautique</h2>
                            <p>
                                loremjioji <br>
                                loremjioji <br>
                                loremjioji <br>
                                loremjioji <br>
                            </p>
                                <h3>Prix unitaire : 1 500Frs </h3>
                        </div>
                    </div>

                    <div class="part">
                        <div class="div">
                           <img src="Assets/Img/img pub/Articles informatiques/Imprimante multifonction Epson EcoTank ET-2870 Wifi.jpg"
                            alt="">
                        </div>

                        <div class="dav">
                            <h1>DESCRIPTION</h1>
                            <h2>Ordinateur Bureautique</h2>
                            <p>
                                loremjioji <br>
                                loremjioji <br>
                                loremjioji <br>
                                loremjioji <br>
                            </p>
                                <h3>Prix unitaire : 1 500Frs </h3>
                        </div>
                    </div>                
                </div>
            </div>
        `;
                } else if (section === "Services") {
                    contenu.innerHTML = `
            <div class="section_service">

                <div class="sous_section_service">
                    <div class="principal">
                        <div class="haut haut1">
                            <h1>INFORMATIQUE</h1>
                            <p>
                                Lorem, ipsum dolor sit amet consectetur
                                adipisici
                            </p>
                        </div>

                        <div class="bas">
                            
                        </div>
                    </div>
                </div>


               <div class="sous_section_service">
                    <div class="principal">
                        <div class="haut haut1">
                            <h1>INFORMATIQUE</h1>
                            <p>
                                Lorem, ipsum dolor sit amet consectetur
                                adipisici
                            </p>
                        </div>

                        <div class="bas">
                            <button onclick="ouvrir()">S'inscrire ! </button>
                        </div>
                    </div>
                </div>

                <div class="sous_section_service">
                    <div class="principal">
                        <div class="haut haut1">
                            <h1>INFORMATIQUE</h1>
                            <p>
                                Lorem, ipsum dolor sit amet consectetur
                                adipisici
                            </p>
                        </div>

                        <div class="bas">
                            <button onclick="ouvrir()">S'inscrire ! </button>
                        </div>
                    </div>
                </div>

                <div class="sous_section_service">
                    <div class="principal">
                        <div class="haut haut1">
                            <h1>INFORMATIQUE</h1>
                            <p>
                                Lorem, ipsum dolor sit amet consectetur
                                adipisici
                            </p>
                        </div>

                        <div class="bas">
                            <button onclick="ouvrir()">S'inscrire ! </button>
                        </div>
                    </div>
                </div>

                <div class="sous_section_service">
                    <div class="principal">
                        <div class="haut haut1">
                            <h1>INFORMATIQUE</h1>
                            <p>
                                Lorem, ipsum dolor sit amet consectetur
                                adipisici
                            </p>
                        </div>

                        <div class="bas">
                            <button onclick="ouvrir()">S'inscrire ! </button>
                        </div>
                    </div>
                </div>

                <div class="sous_section_service">
                    <div class="principal">
                        <div class="haut haut1">
                            <h1>INFORMATIQUE</h1>
                            <p>
                                Lorem, ipsum dolor sit amet consectetur
                                adipisici
                            </p>
                        </div>

                        <div class="bas">
                            <button onclick="ouvrir()">S'inscrire ! </button>
                        </div>
                    </div>
                </div>

                <div class="sous_section_service">
                    <div class="principal">
                        <div class="haut haut1">
                            <h1>INFORMATIQUE</h1>
                            <p>
                                Lorem, ipsum dolor sit amet consectetur
                                adipisici
                            </p>
                        </div>

                        <div class="bas">
                            <button onclick="ouvrir()">S'inscrire ! </button>
                        </div>
                    </div>
                </div>

                <div class="sous_section_service">
                    <div class="principal">
                        <div class="haut haut1">
                            <h1>INFORMATIQUE</h1>
                            <p>
                                Lorem, ipsum dolor sit amet consectetur
                                adipisici
                            </p>
                        </div>

                        <div class="bas">
                            <button onclick="ouvrir()">S'inscrire ! </button>
                        </div>
                    </div>
                </div>

                <div class="sous_section_service">
                    <div class="principal">
                        <div class="haut haut1">
                            <h1>INFORMATIQUE</h1>
                            <p>
                                Lorem, ipsum dolor sit amet consectetur
                                adipisici
                            </p>
                        </div>

                        <div class="bas">
                            <button onclick="ouvrir()">S'inscrire ! </button>
                        </div>
                    </div>
                </div>
            </div>

        `;
                }
            }
        </script>

        <div id="container">
            <!-- Partie gauche -->
            <div class="menu">

                <h1>Onglets</h1>

                <button onclick="changerContenu('Produits')">
                    Produits
                </button>

                <button onclick="changerContenu('Services')">
                    Services
                </button>

                <a href="#">
                    plus d'infos
                </a>

                <a href="#">
                    S'incrire
                </a>
            </div>

            <!-- Partie droite -->
            <div class="contenu" id="contenu">
                <div class="Acceuil">
                    <div class="cent">
                        <img src="Assets/Img/icon_logo/logo-GVAS.png" alt="logo-GVAS">
                        <h1>GROUPE VISION D'AIGLE SERVICES</h1>
                        <P>Spécialiser dans la vente des produits et services</P>
                    </div>
                </div>
            </div>
        </div>

        <section>
            <div class="parie_publicitaire">
                <h1>NOS ANNONCES </h1>
            </div>

            <div class="partie_recrutement">
                <div class="central">
                    <div class="redirections">
                        <div class="bg">
                            <div class="hauteur">
                                <video autoplay controls muted>
                                    <source
                                        src="Assets/video/Marshmello & Bastille - Happier - Traduction Française & Paroles.mp4">
                                </video>
                            </div>
                            <div class="p_bas">
                                <h1>Découvrez notre démo <br>
                                    concernant les avis de recrutement</h1>

                                <p>
                                    Explorez notre interface de recrutement et découvrez ses fonctionnalités. <br>
                                    <i> Service disponible uniquement pendant certaines périodes. </i>
                                </p>

                                <h2>
                                    Cliquez <a href="#">ICI</a> pour éxécuter la démo.
                                </h2>
                            </div>
                        </div>

                        <div class="bg">
                            <div class="hauteur">
                                <video autoplay controls muted>
                                    <source
                                        src="Assets/video/Marshmello & Bastille - Happier - Traduction Française & Paroles.mp4">
                                </video>
                            </div>
                            <div class="p_bas">
                                <h1>Découvrez notre démo <br> concernant la disponsation des cours en ligne</h1>

                                <p>
                                    Accéder à nôtre salle de classe depuis chez vous !! <br>
                                    <i> Service disponible uniquement aux élèves inscrit en fonction des emplois du
                                        temps des cours. </i>
                                </p>

                                <h2>
                                    Cliquez <a href="#">ICI</a> pour éxécuter la démo.
                                </h2>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <section>
            <div class="carouselExampleSlidesOnly2">
                <div class="parie_publicitaire">
                    <h1>NOS PARTENAIRES</h1>
                </div>
                <div id="lien">
                    <div class="partenaires">
                        <a href="https://www.facebook.com/people/Association-des-Jeunes-Eveill%C3%A9s-du-Congo-AJEC/100064026428804/"
                            target="_blank" class="float">
                            <div id="mem">
                                <img src="Assets/Img/Partenaires/AJEC.jpeg" alt="">
                            </div>
                            <div class="memm">
                                <h1>
                                    AJEC (Organisation Non Gouvernementale) <br> Depuis Décembre 2023
                                </h1>
                            </div>
                        </a>

                        <a href="https://www.facebook.com/vipconsultscongob/" target="_blank" class="float">
                            <div id="mem">
                                <img src="Assets/Img/Partenaires/VIP.png" alt="">
                            </div>
                            <div class="memm">
                                <h1>
                                    Cabinet VIP Consult <br> Depuis Décembre 2025
                                </h1>
                            </div>
                        </a>

                        <a href="https://www.airtel.cg/" target="_blank" class="float">
                            <div id="mem">
                                <img src="Assets/Img/Partenaires/R.jpg" alt="">
                            </div>
                            <div class="memm">
                                <h1>
                                    Airtel Congo <br> Depuis Septembre 2025
                                </h1>
                            </div>
                        </a>

                        <a href="https://www.africabizinfo.com/fr-CG/private-school-la-maniguette" target="_blank"
                            class="float">
                            <div id="mem">
                                <img src="Assets/Img/Partenaires/Ecole.png" alt="">
                            </div>
                            <div class="memm">
                                <h1>
                                    Complexe scolaire privé La Maniguette <br> Depuis 2025
                                </h1>
                            </div>
                        </a>

                        <div class="float">
                            <div id="mem">
                                <img src="Assets/Img/Partenaires/cvmc.png" alt="">
                            </div>
                            <div class="memm">
                                <h1>CVMC</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <a href="#ancre" id="foot">
            <h1>
                RETOUR AU SOMMET
            </h1>
        </a>
    </main>

    <!-- footer -->
    <footer>
        <div class="footer_part1">
            <div class="aigle ">
                <div class="flex">
                    <img src="Assets/Img/icon_logo/logo-GVAS.png" alt="icon_logo">
                    <h1>Groupe vision d'Aigle Service</h1>
                </div>
                <p>
                    De réfférence, GVAS est une structure professionnelle composée d’un personnel de qualité agréé
                    par
                    l’État. spécialisé dans la vente des produits et services, l'accompagnement professionnelle à
                    travers des formations qualifiantes et certifiantes mais aussi dans un suivi quelconque en vue
                    d’un domaine professionnel donné.
                </p>
            </div>

            <div class="aigle">
                <h1>Notre localisation</h1>
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m13!1m8!1m3!1d527.374828563409!2d11.9053312!3d-4.8224385!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zNMKwNDknMjEuMCJTIDExwrA1NCcxOS43IkU!5e1!3m2!1sfr!2scg!4v1778953131197!5m2!1sfr!2scg"
                    width="500" height="225" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
                <a href="https://www.google.com/maps/place/4%C2%B049'21.0%22S+11%C2%B054'19.7%22E/@-4.8224385,11.9053312,121m/data=!3m1!1e3!4m4!3m3!8m2!3d-4.8225!4d11.9054722?hl=fr&entry=ttu&g_ep=EgoyMDI2MDUxMy4wIKXMDSoASAFQAw%3D%3D"
                    target="_blank">
                    <h1>
                        " Cliquez ici pour Agrandir la MAPS "
                    </h1>
                </a>
            </div>

           <div class="hide">
             <h1>Suivez nous sur nos pages</h1>
           </div>
            <div id="sous_class_contact">
                <div class="a">
                    <a href="../index.php">
                        <i class="fa-solid fa-house" style="color: rgb(0, 0, 0);"></i>
                    </a>
                </div>

                <div class="a">
                    <a href="https://www.facebook.com/profile.php?id=61583138888176" target="_blank">
                        <i class="fa-brands fa-square-facebook" style="color: rgb(0, 0, 0);"></i>
                    </a>
                </div>

                <div class="a">
                    <a href="#">
                        <i class="fa-brands fa-youtube" style="color: rgb(0, 0, 0);"></i>
                    </a>
                </div>

                <div class="a">
                    <a href="https://wa.me/242064201415" target="_blank">
                        <i class="fa-brands fa-whatsapp" style="color: rgb(0, 0, 0);"></i>
                    </a>
                </div>
            </div>
        </div>

        </div>

        <div class="footer_part2">
            <div class="pat">
                <h1>Entreprise</h1>
                <ul>
                    <li><a href="">Acceuil</a></li>
                    <li><a href="">Formations</a></li>
                    <li><a href="">Propos</a></li>
                    <li><a href="">Page Publicitaire</a></li>
                    <li><a href="">Galerie</a></li>
                </ul>
            </div>

            <div class="pat">
                <h1>Services</h1>
                <ul>
                    <li><a href="">Langues</a></li>
                    <li><a href="">Informatique</a></li>
                    <li><a href="">Pôle Commercial</a></li>
                </ul>
            </div>


            <div class="pat">
                <h1>Contacts</h1>
                <Ul>
                    <li>info@gvas.fr</li>
                    <li>05 344 40 20</li>
                    <li>06 420 14 15</li>
                    <li>06 416 36 21</li>
                </Ul>
            </div>

            <form action="">
                <label for="envoie">
                    <h1 class="hid">
                        Envoyez votre commentaire
                    </h1>
                </label>

                <div>
                    <input class="tim" placeholder="Votre commentaire ici" type="text" name="envoie" id="envoie">

                    <input class="tom" type="submit" value="soumettre !"></input>
                </div>
            </form>
        </div>

        <div class="bas">
            <h1>
                #celui qui ne se forme pas, se déforme !
            </h1>
        </div>
    </footer>

    <script src="Assets/js/index.js"></script>
</body>

</html>