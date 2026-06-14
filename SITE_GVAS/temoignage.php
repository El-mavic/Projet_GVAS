<?php
require 'traitement.php';

$temoignages = $pdo->query(
    "SELECT * FROM temoignages ORDER BY id ASC"
)->fetchAll(PDO::FETCH_ASSOC);
?>

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
    <title>Temoignage</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="Gloire/Assets/Css/style.css">
    <link rel="stylesheet" href="../Gloire/Assets/Css/stilisation.css">

    <!-- <link rel="icon" href="images/Images/GVAS.png"> -->
</head>

<body class="body">

    <div class=" burger-menu ">
        <ul class=" links">
            <li><a href="index.php">Accueil</a></li>
            <li><a href="Formation.php">Formations</a></li>
            <li><a href="Galerie.php">Gallérie</a></li>
            <li><a href="contacts.php">Contacts</a></li>
            <div class="divider"></div>
            <div class="buttons-burger-menu">
                <a class="action-button" href="Gloire/page_publicitaire.php">Pub</a>
                <a class="action-button" style="  white-space: nowrap;" href="vivi/apropos.php">A propos</a>
            </div>
        </ul>
    </div>
    <header id="ancre">

        <div class="navbar">
            <div class="logo">
                <img class="gvas" src="images/Images/GVAS.png" alt="GVAS">

            </div>

            <ul class="links">
                <li><a href="index.php">Accueil</a></li>
                <li><a href="Formation.php">Formations</a></li>
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
    <!-- TEMOIGNAGE -->
    <section class="temoignage">
        <h2>LAISSER UN TEMOIGNAGE DE VOTRE PASSAGE A GVAS</h2>
        <div class="temoignage-box">

            <form action="traitement.php" method="POST">
                <input type="hidden" name="form_type" value="temoignage">

                <textarea
                    name="message"
                    id="message"
                    placeholder="Votre témoignage..." required></textarea>

                <input class="change" type="text" name="nom" placeholder="Veuillez saisir votre nom" required>
                <button type="submit">Envoyer</button>
            </form>

        </div>
        <table id="table-temoignage">
            <thead>
                <tr>
                    <th>N°</th>
                    <th>Nom(s)</th>
                    <th>TEMOIGNAGE</th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($temoignages as $tem): ?>
                    <tr>
                        <td><?= htmlspecialchars($tem['id']) ?></td>
                        <td><?= htmlspecialchars($tem['nom']) ?></td>
                        <td><?= htmlspecialchars($tem['message']) ?></td>


                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>

    </table>


    <!-- btn-retour -->
    <div id="foot">
        <a href="#ancre">
            <h1>
                RETOUR AU SOMMET
            </h1>

            <img src="Gloire/Assets/img/icon_logo/image.jpg" alt="lien_retours">
        </a>
    </div>

    <!-- FOOTER -->
    <footer>
        <div class="footer_part1">
            <div class="aigle ">
                <div class="flex">
                    <img src="images/images/GVAS.png" alt="icon_logo">
                    <h1>Groupe vision d'Aigle Services</h1>
                </div>
                <p id="justP">
                    De référence, GVAS est une structure professionnelle composée d’un personnel de qualité agréé
                    par
                    l’État. spécialisé dans la vente des produits et services, l'accompagnement professionnel à
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

                <a id="H" href="https://www.google.com/maps/place/4%C2%B049'21.0%22S+11%C2%B054'19.7%22E/@-4.8224385,11.9053312,121m/data=!3m1!1e3!4m4!3m3!8m2!3d-4.8225!4d11.9054722?hl=fr&entry=ttu&g_ep=EgoyMDI2MDUxMy4wIKXMDSoASAFQAw%3D%3D"
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
                    <li><a href="../index.php">Accueil</a></li>
                    <li><a href="../formation.php">Formations</a></li>
                    <li><a href="../vivi/apropos.php">A Propos</a></li>
                    <li><a href="../Gloire/page_publicitaire.php">Page Publicitaire</a></li>
                    <li><a href="../galerie.php">Galerie</a></li>
                    <li><a href="../contacts.php">Contacts</a></li>
                    <li><a href="../temoignage.php">Témoignage</a></li>
                    <li><a href="../notre_image.php">Pourquoi GVAS ?</a></li>
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