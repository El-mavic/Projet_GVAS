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

    <script defer src="Assets/js/index.js"></script>
    <link rel="stylesheet" href="Assets/Css/style.css">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="icon" href="Assets/Img/icon_logo/logo-GVAS.png">
    <link rel="icon" href="../style.css">
    <link rel="stylesheet" href="Assets/Css/stilisation.css">

    <link rel="stylesheet" href="../style.css">
    <title>Page Publicitaire</title>
</head>

<body id="tache">
    <!-- *********header********** -->
    <div class=" burger-menu " >
        <ul class=" links">
            <li><a href="../index.php">Accueil</a></li>
            <li><a href="../Formation.php">Formation</a></li>
            <li><a href="../galerie.php">Galerie</a></li>
            <li><a href="../contacts.php">Contacts</a></li>
            <div class="divider"></div>
            <div class="buttons-burger-menu">
                <a class="action-button" href="../temoignage.php">Temoignage</a>
                <a class="action-button" href="../vivi/apropos.php">A propos</a>
            </div>
        </ul>
    </div>
    <header id="ancre">

        <div class="navbar">
            <div class="logo">
                <img class="g" src="Assets/img/icon_logo/logo-GVAS.png">

            </div>

            <ul class="links">
                <li><a href="../index.php">Accueil</a></li>
                <li><a href="../Formation.php">Formations</a></li>
                <li><a href="../galerie.php">Galerie</a></li>
                <li><a href="../contacts.php">Contacts</a></li>
            </ul>
            <div class="buttons">
                <a class="action-button pro " href="../temoignage.php">Temoignage</a>
                <a class="action-button" href="../vivi/apropos.php">A propos</a>
            </div>
            <div class="burger-menu-button">
                <i class="fa-solid fa-bars"></i>
            </div>
        </div>
    </header>

    <p class="texte">Groupe Vision d'Aigle Services </p>

    <main>
        <section id="classeur">
            <div class="classe">
                <div class="defilements">
                    <div>
                        <h1 class="wave">
                            <span>Bienvenu</span>
                            <span>sur</span>
                            <span>notre</span>
                            <span>page</span>
                            <span>publicitaire</span>
                        </h1>
                        <h2>Retrouvrez ici nos actualités sous forme d'informations</h2>
                    </div>
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

                    <!-- POPUP -->
                    <div class="popup" id="popup">
                        <form action="../Traitement.php" method="POST">
                            <input type="hidden" name="form_type" value="abonnement">

                            <input class="up_top" type="email" name="email" id="email"
                                placeholder="Entrez votre adresse mail" required>

                            <button class="down_bottom" type="submit" id="valider">
                                Valider
                            </button>
                        </form>
                    </div>
                </div>
        </section>



        <div class="parie_publicitaire">
            <h1>DECOUVREZ NOS ARTICLES</h1>
        </div>
        <!-- Fenêtre -->

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
                            <img src="Assets/Img/img pub/Articles informatiques/imprimanteG.avif" alt="imprimanteG">
                        </div>
                        <div class="dav">
                            <h1>DESCRIPTION</h1>
                            <h2>IMPRESSIONS BACHES</h2>
                            <ul>
                                <li>
                                    prix : 2500frc (Noir et blanc)
                                </li>   
                            </ul>
                        </div>
                    </div>

                    <div class="part">
                        <div class="div">
                            <img src="Assets/Img/img pub/Articles informatiques/Agrafeuse.jpg" alt="Agrafeuse">
                        </div>

                        <div class="dav">
                            <h1>DESCRIPTION</h1>
                            <h2>AGRAFEUSE</h2>
                            <ul>
                                <li>
                                    prix : 2500frc (Noir et blanc)
                                </li>  
                                <li>
                                    prix : 1500frc (Noir et blanc)
                                </li>   
                            </ul>
                        </div>
                    </div>

                    <div class="part">
                        <div class="div">
                            <img src="Assets/Img/img pub/Articles informatiques/boitierD.jpg" alt="boitierD">
                        </div>

                        <div class="dav">
                            <h1>DESCRIPTION</h1>
                            <h2>BOITIERS DISQUE DURE</h2>
                            <ul>
                                <li>
                                    1To
                                </li>
                                <li>
                                    5OOMB
                                </li>
                                <li>
                                    250MB ...
                                </li>   
                            </ul>
                        </div>
                    </div>

                    <div class="part">
                        <div class="div">
                            <img src="Assets/Img/img pub/Articles informatiques/camera.jpg" alt="camera">
                        </div>

                        <div class="dav">
                            <h1>DESCRIPTION</h1>
                            <h2>CAMERA HOME</h2>
                            <ul>
                                <li>
                                    Disponibles en stock
                                </li>   
                            </ul>
                        </div>
                    </div>

                    <div class="part">
                        <div class="div">
                            <img src="Assets/Img/img pub/Articles informatiques/casque.jpg" alt="casque">
                        </div>

                        <div class="dav">
                            <h1>DESCRIPTION</h1>
                            <h2>CASQUE</h2>
                            <ul>
                                <li>
                                    Disponibles en stock
                                </li>   
                            </ul>
                        </div>
                    </div>

                    
                    <div class="part">
                        <div class="div">
                            <img src="Assets/Img/img pub/Articles informatiques/chargeur.webp" alt="chargeur">
                        </div>

                        <div class="dav">
                            <h1>DESCRIPTION</h1>
                            <h2>CHARGEUR A LAPTOP</h2>
                            <ul>
                                <li>
                                    Disponibles en stock
                                </li>   
                            </ul>
                        </div>
                    </div>

                    <div class="part">
                        <div class="div">
                            <img src="Assets/Img/img pub/Articles informatiques/clé usb.webp" alt="usb">
                        </div>

                        <div class="dav">
                            <h1>DESCRIPTION</h1>
                            <h2>CLE USB</h2>
                            <ul>
                                <li>
                                    1To
                                </li>
                                <li>
                                    5OOMB
                                </li>
                                <li>
                                    250MB ...
                                </li>    
                            </ul>
                        </div>
                        
                    </div>

                    <div class="part">
                        <div class="div">
                            <img src="Assets/Img/img pub/Articles informatiques/desktop.jpg" alt="desktop">
                        </div>

                        <div class="dav">
                            <h1>DESCRIPTION</h1>
                            <h2>ORDINATEUR BUREAUTIQUE</h2>
                            <ul>
                                <li>
                                    disponible en stock
                                </li>
                                <li>
                                    1To
                                </li>
                                <li>
                                    5OOMB
                                </li>
                                <li>
                                    250MB ...
                                </li>    
                            </ul>
                        </div>
                    </div>

                    <div class="part">
                        <div class="div">
                            <img src="Assets/Img/img pub/Articles informatiques/encre.webp" alt="ancre">
                        </div>

                        <div class="dav">
                            <h1>DESCRIPTION</h1>
                            <h2>ANCRE A IMPRIMANTE</h2>
                            <ul>
                                <li>
                                    Disponible en stock
                                </li>    
                            </ul>
                        </div>
                    </div>

                    <div class="part">
                        <div class="div">
                            <img src="Assets/Img/img pub/Articles informatiques/epson.jpg" alt="epson">
                        </div>

                        <div class="dav">
                            <h1>DESCRIPTION</h1>
                            <h2>Ordinateur Bureautique</h2>
                            <ul>
                                <li>
                                    Disponible en stock
                                </li>    
                            </ul>
                        </div>
                    </div>

                    <div class="part">
                        <div class="div">
                            <img src="Assets/Img/img pub/Articles informatiques/headphone.webp" alt="headphone">
                        </div>

                        <div class="dav">
                            <h1>DESCRIPTION</h1>
                            <h2>HEADPHONE</h2>
                            <ul>
                                <li>
                                    Disponible en stock
                                </li>    
                            </ul>
                        </div>
                    </div>
 
                    
                    <div class="part">
                        <div class="div">
                            <img src="Assets/Img/img pub/Articles informatiques/laptop.jpg" alt="laptop">
                        </div>

                        <div class="dav">
                            <h1>DESCRIPTION</h1>
                            <h2>Ordinateur Portatif</h2>
                            <ul>
                                <li>
                                    Disponible en stock
                                </li>    
                            </ul>
                        </div>
                    </div>  

                    <div class="part">
                        <div class="div">
                            <img src="Assets/Img/img pub/Articles informatiques/Mchargeur.jpg" alt="Mchargeur">
                        </div>

                        <div class="dav">
                            <h1>DESCRIPTION</h1>
                            <h2>Chargeur Téléphone</h2>
                            <ul>
                                <li>
                                    Disponible en stock
                                </li>    
                            </ul>
                        </div>
                    </div> 

                    <div class="part">
                        <div class="div">
                            <img src="Assets/Img/img pub/Articles informatiques/sourisf.jpg" alt="sourisf">
                        </div>

                        <div class="dav">
                            <h1>DESCRIPTION</h1>
                            <h2> Souris Avec Fil</h2>
                            <ul>
                                <li>
                                    Disponible en stock
                                </li>    
                            </ul>
                        </div>
                    </div> 

                    <div class="part">
                        <div class="div">
                            <img src="Assets/Img/img pub/Articles informatiques/tout-en-un.jpg" alt="tout-en-un">
                        </div>

                        <div class="dav">
                            <h1>DESCRIPTION</h1>
                            <h2>Ordinateur tout-en-un</h2>
                            <ul>
                                <li>
                                    Disponible en stock
                                </li>    
                            </ul>
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
                            <img src="Assets/Img/img pub/Articles informatiques/services .jpg" alt="">
                        </div>

                        <div class="bas">
                            <h1>SERVICE DE PLASSIFICATION</h1>
                                <ul>
                                    <li>
                                        prix : 500frc (Format A4)
                                    </li>
                                    <li>
                                        prix : 1000frc (Format A3)
                                    </li>
                                </ul>
                        </div>
                    </div>
                </div>

                <div class="sous_section_service">
                    <div class="principal">
                        <div class="haut haut1">
                            <img src="Assets/Img/img pub/Articles informatiques/Simression.jpg" alt="">
                        </div>

                        <div class="bas">
                            <h1>SERVICE DE PHOTOCOPIE</h1>
                            
                                <ul>
                                    <li>
                                        prix : 25frc (Noir et blanc)
                                    </li>
                                    <li>
                                        prix : 150frc (Couleur)
                                    </li>
                                    <li>
                                        prix : 15frc (appartir de 15 copies)
                                    </li>
                                </ul>
                            
                        </div>
                    </div>
                </div>

                <div class="sous_section_service">
                    <div class="principal">
                        <div class="haut haut1">
                            <img src="Assets/Img/img pub/Articles informatiques/imprimanteG.avif" alt="">
                        </div>

                        <div class="bas">
                            <h1>SERVICE D'IMPRESSION BACHES</h1>

                            <ul>
                                <li>
                                    prix : 2500frc (Noir et blanc)
                                </li>   
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="sous_section_service">
                    <div class="principal">
                        <div class="haut haut1">
                            <img src="Assets/Img/img pub/Articles informatiques/WhatsApp Image 2026-05-30 at 1.07.22 PM.jpeg" alt="livre">
                        </div>

                        <div class="bas">
                            <h1>SERVICE DE VENTE <br> ACCESOIR DE BUREAU</h1>
                            <ul>
                                <li>
                                    Disponible en stock
                                </li> 
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="sous_section_service">
                    <div class="principal">
                        <div class="haut haut1">
                            <img src="Assets/Img/img pub/Articles informatiques/cours en presentiel.jpg" alt="livre">
                        </div>

                        <div class="bas">
                            <h1>COURS EN PRESENTIEL </h1>
                            <h1>On s'adapte sur</h1>
                            <ul>
                                <li>
                                    Votre emplois du temps
                                </li> 

                                <li>
                                    La formation demandée
                                </li>
                                
                                <li>
                                    Votre tranche d'êge et autre
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

               <div class="sous_section_service">
                    <div class="principal">
                        <div class="haut haut1">
                            <img src="Assets/Img/img pub/Articles informatiques/reparation.webp" alt="">
                        </div>

                        <div class="bas">
                            <h1>SERVICE DE REPARATION</h1>
                                
                            <ul>
                                <li>
                                    Flash mobile 
                                </li>   
                                <li>
                                    réparation hardware 
                                </li> 
                                <li>
                                    réparation software
                                </li> 
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="sous_section_service">
                    <div class="principal">
                        <div class="haut haut1">
                            <img src="Assets/Img/img pub/Articles informatiques/saisie.jpg" alt="saisie">
                        </div>

                        <div class="bas">
                            <h1>SERVICE BUREAUTIQUE</h1>
                            <ul>
                                <li>
                                    Saisie (appartir de 500frc)
                                </li>   
                                <li>
                                    Conception (appartir de 500frc)
                                </li> 
                            </ul>
                        </div>
                    </div>
                </div>

                 <div class="sous_section_service">
                    <div class="principal">
                        <div class="haut haut1">
                            <img src="Assets/Img/img pub/Articles informatiques/online course.jpg" alt="saisie">
                        </div>

                        <div class="bas">
                            <h1>COURS EN LIGNE</h1>
                            <h1>On s'adapte sur</h1>
                            <ul>
                                <li>
                                    Votre emplois du temps
                                </li> 

                                <li>
                                    La formation demandée
                                </li>
                                
                                <li>
                                    Votre tranche d'êge et autre
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="sous_section_service">
                    <div class="principal">
                        <div class="haut haut1">
                            <img src="Assets/Img/img pub/Articles informatiques/orientation.jpg" alt="orientation">
                        </div>

                        <div class="bas">
                            <h1>SERVICE D'ORIENTATION</h1>
                            <ul>
                                <li>
                                    Orientation quelconque
                                </li>   
                                <li>
                                    Orientation proffesionnel
                                </li> 
                                <li>
                                    Orientation particulière 
                                </li> 
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="sous_section_service">
                    <div class="principal">
                        <div class="haut haut1">
                            <img src="Assets/Img/img pub/Articles informatiques/livre.jpeg" alt="livre">
                        </div>

                        <div class="bas">
                            <h1>SERVICE DE VENTE <br> L'ENFANT INTELLIGENT</h1>
                            <ul>
                                <li>
                                     Histoire-Géographie
                                </li>   
                                <li>
                                    Anglais
                                </li> 
                                <li>
                                    Mathématiques ...
                                </li> 
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="sous_section_service">
                    <div class="principal">
                        <div class="haut haut1">
                            <img src="Assets/Img/img pub/Articles informatiques/MOMO.jpg" alt="momo">
                        </div>

                        <div class="bas">
                            <h1>MTN MOBILE MONEY</h1>
                            <ul>
                                <li>
                                    Dépot et Retrait inclus
                                </li>   
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="sous_section_service">
                    <div class="principal">
                        <div class="haut haut1">
                            <img src="Assets/Img/img pub/Articles informatiques/airtel mo.jpg" alt="airtel">
                        </div>

                        <div class="bas">
                            <div class="bas">
                            <h1>AITEL MOBILE MONEY</h1>
                            <ul>
                                <li>
                                    Dépot et Retrait inclus
                                </li>   
                            </ul>
                        </div>
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
                <div id="display">
                    <div class="flexar">
                        <button onclick="changerContenu('Produits')">
                            Produits
                        </button>

                        <button onclick="changerContenu('Services')">
                            Services
                        </button>
                    </div>

                    <div class="flexy">
                        <a href="../contacts.php">
                            plus d'infos
                        </a>

                        <a href="../index.php">
                            S'incrire
                        </a>
                    </div>
                </div>
            </div>

            <!-- Partie droite -->
            <div class="contenu" id="contenu">
                <div class="Acceuil">
                    <div class="cent">
                        <img src="Assets/Img/icon_logo/logo-GVAS.png" alt="logo-GVAS">
                        <h1 >GROUPE VISION D'AIGLE SERVICES</h1>
                        <P>Spécialiser dans la vente des produits et services</P>
                    </div>
                </div>
            </div>
        </div>

        <section>
            <div class="jaune">
                <h1>NOS ANNONCES </h1>
            </div>

            <div class="bg partie_recrutement">
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
                                    Cliquez <a href="../index.php">ICI</a> pour éxécuter la démo.
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
                                    Cliquez <a href="../index.php">ICI</a> pour éxécuter la démo.
                                </h2>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <section id="Lien">
            <div class="carouselExampleSlidesOnly2">
                <div class="parie_publicitaire">
                    <h1>NOS PARTENAIRES</h1>
                </div>
                <div id="lien">
                    <div class="partenaires">
                        <a href="https://www.facebook.com/people/Association-des-Jeunes-Eveill%C3%A9s-du-Congo-AJEC/100064026428804/"
                            target="_blank" class="float">
                            <div id="mem">
                                <img src="Assets/Img/Partenaires/AJEC.jpeg" alt="AJEC">
                            </div>
                            <div class="memm">
                                <h1>
                                    AJEC (Organisation Non Gouvernementale) <br> Depuis Décembre 2023
                                </h1>
                            </div>
                        </a>

                        <a href="https://www.facebook.com/vipconsultscongob/" target="_blank" class="float">
                            <div id="mem">
                                <img src="Assets/Img/Partenaires/VIP.png" alt="VIP">
                            </div>
                            <div class="memm">
                                <h1>
                                    Cabinet VIP Consult <br> Depuis Décembre 2025
                                </h1>
                            </div>
                        </a>

                        <a href="https://www.airtel.cg/" target="_blank" class="float">
                            <div id="mem">
                                <img src="Assets/Img/Partenaires/R.jpg" alt="AIRTEL">
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
                                <img src="Assets/Img/Partenaires/Ecole.png" alt="CSPM">
                            </div>
                            <div class="memm">
                                <h1>
                                    Complexe scolaire privé La Maniguette <br> Depuis 2025
                                </h1>
                            </div>
                        </a>

                        <div class="float">
                            <div id="mem">
                                <img src="Assets/Img/Partenaires/cvmc.png" alt="CVMC">
                            </div>
                            <div class="memm">
                                <h1>CVMC</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div id="foot">
            <a href="#ancre">
                <h1>
                    RETOUR AU SOMMET
                </h1>

                <img src="Assets/img/icon_logo/image.jpg" alt="lien_retours">
            </a>
        </div>
    </main>

    <!-- footer -->
    <footer>
        <div class="footer_part1">
            <div class="aigle ">
                <div class="flex">
                    <img src="Assets/Img/icon_logo/logo-GVAS.png" alt="icon_logo">
                    <h1>Groupe vision d'Aigle Services</h1>
                </div>
                <p id="justP">
                    De réfférence, GVAS est une structure professionnelle composée d’un personnel de qualité agréé
                    par
                    l’État. spécialisé dans la vente des produits et services, l'accompagnement professionnelle à
                    travers des formations qualifiantes et certifiantes mais aussi dans un suivi quelconque en vue
                    d’un domaine professionnel donné.
                </p>
            </div>

            <div class="aigle">
                <h1>Notre localisation</h1>
                <iframe src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d4218.998780710211!2d11.90546!3d-4.822414!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zNMKwNDknMjAuNyJTIDExwrA1NCcxOS43IkU!5e1!3m2!1sfr!2scg!4v1780334157442!5m2!1sfr!2scg"
                    width="100%" height="225" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>

                <a class="Hici" href="https://www.google.com/maps/place/4%C2%B049'21.0%22S+11%C2%B054'19.7%22E/@-4.8224385,11.9053312,121m/data=!3m1!1e3!4m4!3m3!8m2!3d-4.8225!4d11.9054722?hl=fr&entry=ttu&g_ep=EgoyMDI2MDUxMy4wIKXMDSoASAFQAw%3D%3D"
                    target="_blank">
                    " Cliquez ici pour Agrandir la MAPS "
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
                <h1>Nos pages</h1>
                <ul>
                    <li><a href="../index.php">Acceuil</a></li>
                    <li><a href="../formation.php">Formations</a></li>
                    <li><a href="../vivi/apropos.php">A_Propos</a></li>
                    <li><a href="page_publicitaire.php">Page Publicitaire</a></li>
                    <li><a href="../galerie.php">Galerie</a></li>
                    <li><a href="../contacts.php">Contacts</a></li>
                    <li><a href="../temoignage.php">Témoignage</a></li>
                </ul>
            </div>

            <div class="pat">
                <h1>Nos Services</h1>
                <ul>
                    <li><a href="../formation.php">Langues</a></li>
                    <li><a href="../formation.php">Informatique</a></li>
                    <li><a href="../formation.php">Pôle Commercial</a></li>
                </ul>
            </div>


            <div class="pat">
                <h1>Nos Contacts</h1>
                <ul>
                    <li>info@gvas.fr</li>
                    <li>(+242) 05 344 40 20</li>
                    <li>(+242) 06 420 14 15</li>
                    <li>(+242) 06 416 36 21</li>
                </ul>
            </div>

            <div class="form">
                <form action="../Traitement.php" method="POST">
                    <input type="hidden" name="form_type" value="commentaire">
                    <label for="envoie">
                        <h1 class="hid">
                            Envoyez votre commentaire
                        </h1>
                    </label>
                    <div>
                        <input class="tim" placeholder="Votre commentaire ici" type="text" name="envoie" id="envoie" required>
                        <input class="tom" type="submit" value="soumettre !"></input>
                    </div>
                </form>

                <div id="sous_class_contact">
                    <div class="a">
                        <a class="b" class="card1" href="../index.php">
                            <i class="fa-solid fa-house" style="color: rgb(0, 0, 0);"></i>
                        </a>
                    </div>

                    <div class="a">
                        <a class="b" class="card2" href="https://www.facebook.com/profile.php?id=61583138888176" target="_blank">
                            <i class="fa-brands fa-square-facebook" style="color: rgb(0, 0, 0);"></i>
                        </a>
                    </div>

                    <div class="a">
                        <a class="b" class="card3" href="#">
                            <i class="fa-brands fa-youtube" style="color: rgb(0, 0, 0);"></i>
                        </a>
                    </div>

                    <div class="a">
                        <a class="b" class="card4" href="https://wa.me/242064201415" target="_blank">
                            <i class="fa-brands fa-whatsapp" style="color: rgb(0, 0, 0);"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="bas">
            <h1>
                #celui qui ne se forme pas, se déforme !
            </h1>
        </div>
    </footer>

    <!--burgerMenuButton -->
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