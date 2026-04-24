<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    //1) Validations des données;
    $errors = [];

    if (!isset($_POST['username']) || empty($_POST['username'])) $errors['username'] = "Ce champs est obligatoire";
    if (!isset($_POST['prenom']) || empty($_POST['prenom'])) $errors['prenom'] = "Ce champs est obligatoire";
    if (!isset($_POST['date']) || empty($_POST['date'])) $errors['date'] = "Ce champs est obligatoire";
    if (!isset($_POST['quater']) || empty($_POST['quater'])) $errors['quater'] = "Ce champs est obligatoire";
    if (!isset($_POST['comp']) || empty($_POST['comp'])) $errors['comp'] = "Ce champs est obligatoire";

    if (!isset($_POST['inf']) && !isset($_POST['ang']) && !isset($_POST['exc']) && !isset($_POST['comp']))
        $errors['formation'] = "Selectionne un module";

    if (empty($errors)) {
    }
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
    <link rel="stylesheet" href="style.css">
    <title>Groupe Vision d'Aigle Servive </title>
</head>

<body>
    <header>
        <div class="navbar">
            <div class="logo"><a href="#"></a></div>
            <div class="logo">
                <img class="gvas" src="images/Images/GVAS.png" alt="GVAS">
            </div>

            <ul class="links">
                <li><a href="index.php">Accueil</a></li>
                <li><a href="Formation.php">Formations</a></li>
                <li><a href="Galerie.php">Galerie</a></li>
                <li><a href="contacts.php">Contacts</a></li>
            </ul>
            <div class="buttons">
                <a class="action-button pro " href="#">Welcome</a>
                <a class="action-button" href="apropos.html">A propos</a>
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
                    <a class="action-button-pr " href="#">Welcome!</a>
                    <a class="action-button" href="#">A propos</a>
                </div>
            </ul>
        </div>
    </header>



    <!--Image + Animation-->
    <p class="texte">Bienvenue au Groupe Vision d'Aigle Services </p>
    <div class="table">
        <img class="table1" src="images/BG/Rond.JPG" alt="table">
        <img class="table2" src="images/BG/12.JPG" alt="table">
    </div>

    <!--Boutton d'inscription-->
    <button id="btnInscription" class="btn-primary">Inscription</button>

    <div id="modal" class="modal">
        <div class="modal-content animate">
            <span id="closeBtn" class="close">&times;</span>

            <h2 class="modal-title">Page d'inscription</h2>

            <form class="form-group" action="formulaire.php" method="post">
                <div class="input-box">
                    <label>Nom</label>
                    <input type="text" name="username" placeholder="Entrez votre nom" value="<?= $_POST['username'] ?? '' ?>">
                    <span class="Erreur"><?= $errors['username'] ?? "" ?></span>

                </div>

                <div class="input-box">
                    <label>Prénom</label>
                    <input type="text" name="prenom" placeholder="Entrez votre prénom" value="<?= $_POST['prenom'] ?? '' ?>">
                    <span class="Erreur"><?= $errors['prenom'] ?? "" ?></span>
                </div>

                <div class="input-box">
                    <label>Date de naissance</label>
                    <input type="date" name="date" value="<?= $_POST['date'] ?? '' ?>">
                    <span class="Erreur"><?= $errors['date'] ?? "" ?></span>
                </div>

                <div class="input-box">
                    <label>Sexe</label>

                    <div class="radio-group">
                        <label>
                            <input type="radio" name="sexe" value="Masculin"> Masculin
                        </label>

                        <label>
                            <input type="radio" name="sexe" value="Féminin"> Féminin
                        </label>
                    </div>

                    <div class="input-box">
                        <label>Téléphone</label>
                        <input type="tel" name="tel" placeholder="Entrez votre numero" value="<?= $_POST['tel'] ?? '' ?>">
                        <span class="Erreur"><?= $errors['tel'] ?? "" ?></span>

                    </div>
                    <div class="input-box">
                        <label>Quartier</label>
                        <input type="text" name="quater" placeholder="Votre quartier" value="<?= $_POST['quater'] ?? '' ?>">
                        <span class="Erreur"><?= $errors['quater'] ?? "" ?></span>
                    </div>

                    <div class="dropdown-container">

                        <div id="dropdownBtn" class="dropdown-btn">
                            Sélectionnez des matières
                        </div>

                        <ul id="optionsList" class="options">
                            <li>
                                <input type="checkbox" value="Informatique" id="inf">
                                <label for="inf">Informatique Bureautique</label>
                            </li>

                            <li>
                                <input type="checkbox" value="Anglais" id="ang">
                                <label for="ang">Anglais</label>
                            </li>

                            <li>
                                <input type="checkbox" value="reseau" id="rx">
                                <label for="excel">Réseau informatique </label>
                            </li>

                            <li>
                                <input type="checkbox" value="logistique" id="log">
                                <label for="compta">Logistique</label>
                            </li>

                            <li>
                                <input type="checkbox" value="maintenance" id="maint">
                                <label for="compta">Maintenance des Ordinateurs</label>
                            </li>
                            <li>
                                <input type="checkbox" value="maintenance" id="maint">
                                <label for="compta">Comptabilité</label>
                            </li>
                        </ul>
                        <button type="submit" class="btn-submit">Envoyer</button>
                    </div>
                </div>

            </form>
        </div>
    </div>


    <!--burgerMenuButton-->

    <script>
        const burgerMenuButton = document.querySelector('.burger-menu-button')
        const burgerMenuButtonIcon = document.querySelector('.burger-menu-button i')
        const burgerMenu = document.querySelector('.burger-menu')

        burgerMenuButton.onclick = function() {
            burgerMenu.classList.toggle('open')
            const isOpen = burgerMenu.classList.contains('open')
            burgerMenuButtonIcon.classList = isOpen ? 'fa-solid fa-xmark' : 'fa-solid fa-bars'
        }
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