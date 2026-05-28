<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //1) Validations des données;
    $errors = [];
    if (!isset($_POST['nom']) || empty($_POST['nom'])) $errors['nom'] = "Ce champs est obligatoire";
    if (!isset($_POST['prenom']) || empty($_POST['prenom'])) $errors['prenom'] = "Ce champs est obligatoire";
    if (!isset($_POST['date']) || empty($_POST['date'])) $errors['date'] = "Ce champs est obligatoire";
    if (!isset($_POST['quartier']) || empty($_POST['quartier'])) $errors['quartier'] = "Ce champs est obligatoire";
    if (!isset($_POST['telephone']) || empty($_POST['telephone'])) $errors['telephone'] = "Ce champs est obligatoire";

    if (empty($_POST['sexe'])) {
        $errors['sexe'] = "Selectionnez votre sexe";
    }
    if (empty($_POST['formation'])) {
        $errors['formation'] = "Veuillez choisir une formation";
    }
    if (empty($errors)) {
        echo "Validé";
    } else {
        print_r($errors);
    }
}
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link rel="icon" href="images/Images/GVAS.png">
    <link rel="stylesheet" href="style.css">
    <title>Groupe Vision d'Aigle Services</title>
</head>

<body>

    <header>
        <div class="navbar">
            <div class="logo">
                <img class="gvas" src="images/Images/GVAS.png" alt="GVAS">
            </div>

            <ul class="links">
                <li><a href="Temoignage.php">Temoignage</a></li>
                <li><a href="Formation.php">Formations</a></li>
                <li><a href="Galerie.php">Galerie</a></li>
                <li><a href="contacts.php">Contacts</a></li>
            </ul>
            <div class="buttons">
                <a class="action-button pro " href="Gloire/page_publicitaire.php">Pub</a>
                <a class="action-button" href="vivi/apropos.html">A propos</a>
            </div>
            <div class="burger-menu-button">
                <i class="fa-solid fa-bars"></i>
            </div>
        </div>
        <div class="burger-menu ">
            <ul class="links">
                <li><a href="index.html">Accueil</a></li>
                <li><a href="Formation.html">Formations</a></li>
                <li><a href="Galerie.html">Gallérie</a></li>
                <li><a href="contacts.html">Contacts</a></li>
                <div class="divider"></div>
                <div class="buttons-burger-menu">
                    <a class="action-button" href="Gloire/page_publicitaire.php">Pub</a>
                    <a class="action-button" href="vivi/apropos.html">A propos</a>
                </div>
            </ul>
        </div>
    </header>

    <!--La première page qui survole--
    <div id="welcome-screen">
        <img class="welcome-image" src="images/Images/GVAS.png" alt="Bienvenue">
        <h1>Bienvenue au Groupe Vision d'Aigle Services</h1>
        <p> Qui ne se forme pas se déforme. </p>
    </div>-->

    <!--Image + Animation-->
    <p class="texte">Bienvenue au Groupe Vision d'Aigle Services </p>
    <div class="table">
        <img class="table1" src="images/BG/Rond.JPG" alt="table">
        <img class="table2" src="images/BG/12.JPG" alt="table">
    </div>

    <!--Boutton d'inscription-->
    <button id="btnInscription" class="btn-primary">
        Inscription
    </button>
    <div id="modal" class="modal">
        <div class="modal-content animate">
            <span id="closeBtn" class="close">&times;</span>

            <h2 class="modal-title">Page d'inscription</h2>

            <form class="form-group" action="Traitement.php" method="POST">
                <input type="hidden" name="form_type" value="inscriptions" placeholder="Entrez votre nom">
                <input type="hidden" name="type" value="inscription">
                <div class="input-box">
                    <label>Nom</label>
                    <input type="text" name="nom" placeholder="Entrez votre nom" value="<?= $_POST['nom'] ?? '' ?>" required>
                    <span class="Erreur"><?= $errors['nom'] ?? "" ?></span>

                </div>

                <div class="input-box">
                    <label>Prénom</label>
                    <input type="text" name="prenom" placeholder="Entrez votre prénom" value="<?= $_POST['prenom'] ?? '' ?>" required>
                    <span class="Erreur"><?= $errors['prenom'] ?? "" ?></span>
                </div>

                <div class="input-box">
                    <label>Date de naissance</label>
                    <input type="date" name="date" value="<?= $_POST['date'] ?? '' ?>" required>
                    <span class="Erreur"><?= $errors['date'] ?? "" ?></span>
                </div>

                <div class="input-box">
                    <label>Sexe</label>

                    <div class="radio-group">
                        <label>
                            <input type="radio" name="sexe" value="Masculin"
                                <?= (isset($_POST['sexe'])) && ($_POST['sexe'] == "Masculin") ? "checked" : "" ?> required> Masculin
                        </label>

                        <label>
                            <input type="radio" name="sexe" value="Féminin"
                                <?= (isset($_POST['sexe'])) && ($_POST['sexe'] == "Feminin") ? "checked" : "" ?>> Féminin
                        </label>
                    </div>

                    <div class="input-box">
                        <label>Téléphone</label>
                        <input type="tel" name="telephone" placeholder="Entrez votre numero" value="<?= $_POST['telephone'] ?? '' ?>" required>
                        <span class="Erreur"><?= $errors['telephone'] ?? "" ?></span>

                    </div>
                    <div class="input-box">
                        <label>Quartier</label>
                        <input type="text" name="quartier" placeholder="Votre quartier" value="<?= $_POST['quartier'] ?? '' ?>" required>
                        <span class="Erreur"><?= $errors['quartier'] ?? "" ?></span>
                    </div>

                    <div class="dropdown-container">

                        <div id="dropdownBtn" class="dropdown-btn">
                            Sélectionnez des matières
                        </div>

                        <ul id="optionsList" class="options">
                            <li>
                                <input type="checkbox" value="Informatique" id="inf" name="formation[]">
                                <label for="inf">Informatique Bureautique</label>
                            </li>

                            <li>
                                <input type="checkbox" value="Anglais" id="ang" name="formation[]">
                                <label for="ang">Anglais</label>
                            </li>

                            <li>
                                <input type="checkbox" value="Reseau" id="rx" name="formation[]">
                                <label for="rx">Réseau Informatique </label>
                            </li>

                            <li>
                                <input type="checkbox" value="Logistique" id="log" name="formation[]">
                                <label for="log">Logistique</label>
                            </li>

                            <li>
                                <input type="checkbox" value="Maintenance" id="maint" name="formation[]">
                                <label for="maint">Maintenance des Ordinateurs</label>
                            </li>
                            <li>
                                <input type="checkbox" value="Comptabilite" id="compta" name="formation[]">
                                <label for="compta">Comptabilité</label>
                            </li>
                        </ul>
                        <button type="submit" class="btn-submit">Envoyer</button>
                    </div>
                </div>

            </form>
        </div>
    </div>

    <div class="fab-container">
        <!-- Bouton principal -->
        <div class="fab-main" onclick="toggleFab()">
            <i class="fa-solid fa-comments"></i>
        </div>

        <!-- Actions -->
        <div class="fab-actions">


            <!-- RENDEZ-VOUS -->
            <a href="https://www.google.com/maps/place/4%C2%B049'21.0%22S+11%C2%B054'19.7%22E/@-4.8224385,11.9053312,80m/
            data=!3m1!1e3!4m4!3m3!8m2!3d-4.82249!4d11.9054683?hl=
            fr&entry=ttu&g_ep=EgoyMDI2MDQyNy4wIKXMDSoASAFQAw%3D%3D" class="fab-item">
                <span class="fab-label">Notre localisation</span>
                <div class="fab-btn">
                    <i class="fa-solid fa-location-dot"></i>
                </div>
            </a>

            <!-- WHATSAPP -->
            <a href="https://wa.me/242064201415" target="_blank" class="fab-item">
                <span class="fab-label">Contactez via WhatsApp</span>
                <div class="fab-btn">
                    <i class="fa-brands fa-whatsapp"></i>
                </div>
            </a>

            <!-- E-MAIL -->
            <a href="https://mail.google.com/mail/?view=cm&fs=1&to=info@gvas.fr" target="_blank" class="fab-item">
                <span class="fab-label">Contactez via E-mail</span>
                <div class="fab-btn">
                    <i class="fa-solid fa-envelope"></i>
                </div>
            </a>

        </div>
    </div>
    <div class="contentes"></div>

    <!--Pour la petite fenetre quant le formulaire est envoyer
    <script>
        fetch("Traitement.php", {
                method: "POST",
                body: new FormData(document.querySelector("form"))
            })
            .then(res => res.text())
            .then(data => {
                document.getElementById("message").innerHTML = data;
            });
    </script>-->

    <!Pour le chatbot>
        <script>
            function toggleFab() {
                document.querySelector(".fab-container").classList.toggle("active");
            }

            // Fermer si on clique en dehors
            document.addEventListener("click", function(e) {
                const fab = document.querySelector(".fab-container");

                // Vérifie si le clic est en dehors du fab
                if (!fab.contains(e.target)) {
                    fab.classList.remove("active");
                }
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


        <!--Script pour la fenêtre d'inscription-->
        <script>
            // ouvrir
            document.getElementById("btnInscription").onclick = function() {
                document.getElementById("modal").style.display = "flex";
            }

            // fermer
            document.getElementById("closeBtn").onclick = function() {
                document.getElementById("modal").style.display = "none";
            }

            // fermer si on clique en dehors
            window.onclick = function(event) {
                if (event.target === document.getElementById("modal")) {
                    document.getElementById("modal").style.display = "none";
                }
            }
        </script>

        <!--Pour la selection des matières-->
        <script>
            const btn = document.getElementById("dropdownBtn");
            const list = document.getElementById("optionsList");

            btn.addEventListener("click", () => {
                list.style.display = list.style.display === "block" ? "none" : "block";
            });

            // Met à jour le texte du bouton quand les choix changent
            document.querySelectorAll("input[type='checkbox']").forEach(check => {
                check.addEventListener("change", () => {
                    const selected = [...document.querySelectorAll("input[type='checkbox']:checked")]
                        .map(item => item.value);

                    btn.textContent = selected.length > 0 ?
                        selected.join(", ") :
                        "Sélectionnez des matières";
                });
            });

            // Ferme si on clique ailleurs
            document.addEventListener("click", (e) => {
                if (!btn.parentElement.contains(e.target)) {
                    list.style.display = "none";
                }
            });
        </script>
</body>

</html>