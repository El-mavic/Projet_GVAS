<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="burger-menu ">
        <ul class="links">
            <li><a href="/index.php">Accueil</a></li>
            <li><a href="/Formation.php">Formations</a></li>
            <li><a href="/galerie.php">Galerie</a></li>
            <li><a href="/contacts.php">Contacts</a></li>
            <div class="divider"></div>
            <div class="buttons-burger-menu">
                <a class="action-button" href="/Gloire/page_publicitaire.php">Pub</a>
                <a class="action-button" style="white-space: nowrap;" href="/Vivi/apropos.php">A propos</a>
            </div>
        </ul>
    </div>

    <header>

        <div class="navbar">
<<<<<<< HEAD
=======
            <div class="logo">
<<<<<<< HEAD
                <img class="img" src="/Gloire/Assets/img/icon_logo/logo-GVAS.png"alt="icon_logo">
                <img src="/Gloire/Assets/img/icon_logo/logo-GVAS.png"alt="icon_logo">
=======
                <img class="gvas" src="/images/Images/GVAS.png" alt="GVAS">
>>>>>>> 4d16e9dd476d60759b732f01964cc9a4c1abe021
            </div>
            <!-- /*onerror="this.style.display='none';"*/ -->


>>>>>>> e479de0873c52b1387a29a49c34a8bc736cadd3f
            <ul class="links">
                <li><a href="/index.php">Accueil</a></li>
                <li><a href="/Formation.php">Formations</a></li>
                <li><a href="/galerie.php">Galerie</a></li>
                <li><a href="/contacts.php">Contacts</a></li>
            </ul>
            <div class="buttons">
                <a class="action-button pro " href="/temoignage.php">Temoignage</a>
                <a class="action-button" href="/Vivi/apropos.php">A propos</a>
            </div>
            <div class="burger-menu-button">
                <i class="fa-solid fa-bars"></i>
            </div>
        </div>

    </header>
    <!--------------------------------------Message de GVAS BIENVENUE---------------------------------------------------------------->

<<<<<<< HEAD
    <p class="texte">Groupe Vision d'Aigle Services </p>
=======
    <p class="texte"> Groupe Vision d'Aigle Services </p>
>>>>>>> 4d16e9dd476d60759b732f01964cc9a4c1abe021


    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Roboto Condensed", sans-serif;
        }

        body {
            height: 100vh;
            background-image: url(images/Images/Two.jpg);
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        li {
            list-style: none;
        }

        a {
            text-decoration: none;
            color: white;
            font-size: 1.5em;
        }

        a:hover {
            color: #fff200;
        }

        header {
            position: relative;
            /* padding: 0 8em; */
            background-color: rgba(19, 22, 22, 0.61);
            border-bottom-left-radius: 50px;
            border-top-left-radius: 50px;
            border-bottom-right-radius: 50px;
            border-top-right-radius: 50px;
        }

        header .navbar .logo img {
            display: flex;
            width: 100px;
            position: relative;
            left: -156px;
            top: -18px;
        }

        header .navbar .logo .img {
            display: none;
        }

        .buttons {
            display: flex;
            gap: 10px;
            position: relative;
            top: -18px;
        }

        /*-----Burger menu----*/
        .burger-menu {
            display: none;
            height: 0;
            position: absolute;
            right: 2rem;
            top: 60px;
            width: 200px;
            background: rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(15px);
            border-radius: 10px;
            overflow: hidden;
            transition: height cubic-bezier(0.175, 0.885, 0.32, 1.275);

        }

        .burger-menu.open {
            height: 310px;
        }



        .burger-menu li {
            padding: 0.19rem;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-left: -100px;
        }

        .divider {
            height: 1px;
            background: #fff;
            width: 80%;
            margin-left: -30px;
            margin-bottom: 1rem;
        }



        .burger-menu .action-button {
            width: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /*------Suite----*/

        .texte {
            font-size: 3em;
            font-weight: bold;
            align-items: center;
            text-align: center;
            background: linear-gradient(90deg, #7c7f80, #fffb0096);
            font-family: Dutch801 XBd BT;

        }

        /*--------Responsive-------*/
        @media (max-width: 414px) 
        {
            header .burger-menu-button {
                position: relative;
                left: 189%;
                top: -605%;
            }
        }
    
        @media (max-width:990px)
         {
            .texte {
                font-size: 2rem;
            }

            header .burger-menu-button  {
                display: block;
                position: relative;
                left: 0px;
                top: -18px;
            }

            header {
                background: none;
            }

            header .navbar .logo img {
                display: none;
        } 

            header .navbar .logo .img {
            display: block;
            width: 100px;
            position: relative;
            left: -80%;
            top: 0px;
        }

            .navbar .links,
            .navbar .action-button {
                display: none;

            }

            .navbar .burger-menu-button {
                display: block;

            }

            .burger-menu {
                display: block;

            }
        }

        @media (max-width:576px) {

            .burger-menu {
                position: block;
                z-index: 9999;
            }
        }

        /*--- Logo + burger---*/

        @media (max-width:500px) {

            .gvas {
                width: 5rem;
                margin-top: -40px;
            }


            header {
                display: block;
            }

        }

        /*pour la première page*/

        @media (max-width: 1366px) {
            .table {
                margin-top: 30px;
            }

            .buttons {
                position: relative;
                left: 90px;
            }

            .links {
                position: relative;
                left: 50px;
            }

            .btn-primary {
                margin-left: 1px;
            }

            header .navbar .logo .img {
            display: block;
            width: 100px;
            position: relative;
            left: -80%;
            top: -13px;
        }

        }

    </style>




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