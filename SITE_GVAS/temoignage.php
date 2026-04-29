<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Temoignage</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<body class="body">

    <header classe="header">
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
            <form>
                <textarea id="message" placeholder="Votre témoignage..."></textarea>
                <input class="change" type="text" name="nom" placeholder="Veuillez saisir votre nom" required>
                <button onclick="ajouterTemoignage()" type="submit">Envoyer</button>
            </form>
        </div>
        <table id="table-temoignage">
            <thead>
                <tr>
                    <th>N°</th>
                    <th>TEMOIGNAGE</th>
                    <th>Nom(s)</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </section>

    <!-- FOOTER -->
    <footer class="footer">
        <div class="footer-container">

            <div class="footer-col">
                <h3>MonEntreprise</h3>
                <p>Solution professionnelle pour vos besoins digitaux. Performance, sécurité et innovation.</p>
            </div>

            <div class="footer-col">
                <h4>Liens rapides</h4>
                <ul>
                    <li><a href="#">Accueil</a></li>
                    <li><a href="#">Services</a></li>
                    <li><a href="#">À propos</a></li>
                    <li><a href="#">Contact</a></li>
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
                <h4>Newsletter</h4>
                <form action="index.php" method="GET">
                    <button type="submit">S'inscrire</button>
                </form>
            </div>

        </div>

    </footer>

    <!-- PARTENAIRES -->
    <section class="partners">
        <h2>Nos partenaires</h2>
        <div class="partners-container">
            <div class="partner"><img src="images/Formation/2.jpg" alt="partenaire">
                <h3>Bon</h3>
            </div>
            <div class="partner"><img src="images/Formation/2.jpg" alt="partenaire">
                <h3>Bon</h3>
            </div>
            <div class="partner"><img src="images/Formation/2.jpg" alt="partenaire">
                <h3>Bon</h3>
            </div>
            <div class="partner"><img src="images/Formation/2.jpg" alt="partenaire">
                <h3>Bon</h3>
            </div>
            <div class="partner"><img src="images/Formation/2.jpg" alt="partenaire">
                <h3>Bon</h3>
            </div>
        </div>
    </section>
    </footer>
    <script>
        let compteur = 1;

        // Charger les témoignages au démarrage
        window.onload = function() {
            const temoignages = JSON.parse(localStorage.getItem('temoignages')) || [];

            const table = document.querySelector('#table-temoignage tbody');

            temoignages.forEach((msg, index) => {
                const row = document.createElement('tr');
                row.innerHTML = `
            <td>${index + 1}</td>
            <td>${msg}</td>
        `;
                table.appendChild(row);
            });
            compteur = temoignages.length + 1;
        }

        function ajouterTemoignage() {
            const message = document.getElementById('message').value;

            if (message.trim() === '') {
                alert('Veuillez saisir un témoignage');
                return;
            }

            const table = document.querySelector('#table-temoignage tbody');

            const row = document.createElement('tr');

            row.innerHTML = `
        <td>${compteur++}</td>
        <td>${message}</td>`;

            table.appendChild(row);

            // Sauvegarde dans localStorage
            let temoignages = JSON.parse(localStorage.getItem('temoignages')) || [];
            temoignages.push(message);
            localStorage.setItem('temoignages', JSON.stringify(temoignages));

            document.getElementById('message').value = '';
        }
    </script>

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