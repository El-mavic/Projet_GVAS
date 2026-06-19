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
    <link rel="icon" href="images/Images/GVAS.png">
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
                <a class="action-button" href="vivi/apropos.php">A propos</a>
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

    <!-- footer -->
     <div id="foot">
            <a href="#ancre">
                <h1>
                    RETOUR AU SOMMET
                </h1>

                <img src="Gloire/Assets/img/icon_logo/image.jpg" alt="lien_retours">
            </a>
        </div>
    <?php include 'footer.php'; ?>
    

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