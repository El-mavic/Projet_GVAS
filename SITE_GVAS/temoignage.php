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
    <title>Temoignage</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="images/Images/GVAS.png">
</head>

<body class="body">

    <header>
        <div class="container">
            <div class="logo">Groupe Vision d'Aigle Services</div>

            <nav id="nav">
                <ul>
                    <li><a href="index.php">Accueil</a></li>
                    <li><a href="Formation.php">Formations</a></li>
                    <li><a href="galerie.php">Galerie</a></li>
                    <li><a href="contacts.php">Contact</a></li>
                    <li><a href="a-propos.php">À propos</a></li>

                </ul>
            </nav>

            <div class="menu-toggle" id="menu-toggle">
                <span></span>
                <span></span>
                <span></span>
            </div>

        </div>
    </header>

    <!-- TEMOIGNAGE -->
    <section class="temoignage">
        <h2>LAISSER UN TEMOIGNAGE DE VOTRE PASSAGE A GVAS</h2>
        <div class="temoignage-box">

            <form action="traitement.php" method="POST">
                <input type="hidden" name="form_type" value="temoignage">

                <textarea
                    name="message"
                    id="message"
                    placeholder="Votre témoignage..."
                    required>
    </textarea>

                <input
                    class="change"
                    type="text"
                    name="nom"
                    placeholder="Veuillez saisir votre nom"
                    required>

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
    <section class="partners">
        <div class="footer-container">
            <div class="footer-col">
                <h4>MonEntreprise</h4>
                <p>Solution professionnelle pour vos besoins digitaux. Performance, sécurité et innovation.</p>
            </div>

            <div class="footer-col">
                <h4>Liens rapides</h4>
                <ul>
                    <li><a href="index.php">Accueil</a></li>
                    <li><a href="Formation.php">Formations</a></li>
                    <li><a href="galerie.php">Galerie</a></li>
                    <li><a href="contacts.php">Contact</a></li>
                    <li><a href="a-propos.php">À propos</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4>Contact</h4>
                <p>Email : info@gmail.com</p>
                <p>Tél : +242 06 416 36 21 </p>
                <p>Tél : +242 05 344 40 20 </p>
                <p>Pointe-Noire, Congo</p>
            </div>

            <div class="footer-col">
                <a href="index.php"> <button type="button" class="open-inscription">S'inscrire</button></a>
            </div>
        </div>
        <h2>Nos partenaires</h2>
        <div class="partners-container">

            <div class="partner"> <a href="https://www.airtel.cg/" target="_blank">
                    <img src="images/Partenaires/R.jpg" alt="partenaire"></a>
                <h3>Airtel Congo</h3>
            </div>
            <div class="partner"><a href="https://www.africabizinfo.com/fr-CG/private-school-la-maniguette" target="_blank">
                    <img src="images/Partenaires/Ecole.png" alt="partenaire"></a>
                <h3>Ecole Privée la MANINGUETTE</h3>
            </div>
            <div class="partner"><a href="https://www.facebook.com/vipconsultscongob/" target="_blank">
                    <img src="images/Partenaires/VIP.png" alt="partenaire"></a>
                <h3>VIP Consult</h3>
            </div>
            <div class="partner"><a href="https://www.facebook.com/people/Association-des-Jeunes-Eveill%C3%A9s-du-Congo-AJEC/100064026428804/" target="_blank">
                    <img src="images/Partenaires/AJEC.jpeg" alt="partenaire"></a>
                <h3>A.J.E.C</h3>
            </div>
            <div class="partner"><img src="images/Partenaires/cvmc.png" alt="partenaire">
                <h3>NKOMBO -(CVMC)</h3>
            </div>
        </div>
    </section>
    </footer>


    <script>
        const toggle = document.getElementById('menu-toggle');
        const nav = document.getElementById('nav');

        toggle.addEventListener('click', (e) => {
            e.stopPropagation();
            nav.classList.toggle('active');
        });

        // Fermer le menu si on clique ailleurs
        document.addEventListener('click', (e) => {
            if (!nav.contains(e.target) && !toggle.contains(e.target)) {
                nav.classList.remove('active');
            }
        });

        // Empêcher la fermeture si on clique dans le menu
        nav.addEventListener('click', (e) => {
            e.stopPropagation();
        });
    </script>

</body>

</html>