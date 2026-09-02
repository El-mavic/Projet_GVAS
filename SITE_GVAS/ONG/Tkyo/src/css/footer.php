    <!-- FOOTER MODERNE -->
    <footer class=" footer-modern" id="footer"><!--J'ai ajouter Id-->

        <div class="footer-modern-inner">

            <div class="footer-main">

                <!-- Logo + identité -->
                <div class="footer-identity">
                    <a href="#accueil" class="footer-logo">
                        <img src="assets/logo.png" alt="Logo GVAS">
                    </a>

                    <div class="Footerlogo">
                        <strong>GVAS</strong>
                        <span>Action Sociale</span>
                    </div>
                </div>

                <!-- Navigation -->
                <nav class="footer-nav">
                    <a href="../../ong.php">Accueil</a>
                    <a href="../../Vika/mission.html">Mission</a>
                    <a href="../../ong.php/#valeurs">Valeurs</a>
                    <a href="../../ong.php/#actions">Actualités</a>

                </nav>

                <!-- Réseaux -->
                <div class="footer-social">
                    <a href="#" aria-label="Facebook"> <i class="fab fa-facebook-f"></i></a>
                    <a href="#" aria-label="YouTube"> <i class="fab fa-youtube"></i></a>
                    <a href="#" aria-label="TikTok"><i class="fab fa-tiktok"></i></a>
                </div>

            </div>
            <!-- INFORMATIONS DE CONTACT -->
            <div class="footer-contact">

                <a href="tel:+242057554400" class="footer-contact-item">
                    <span class="contact-icon"> <i class="fa-solid fa-phone"></i></span>
                    <span>+242 05 755 44 00</span>
                </a>

                <a href="https://wa.me/242057554400" target="_blank" class="footer-contact-item">
                    <span class="contact-icon"> <i class="fa-brands fa-whatsapp"></i></span>
                    <span>WhatsApp</span>
                </a>

                <a href="mailto:actionsocialegvas@gmail.com" class="footer-contact-item">
                    <span class="contact-icon"> <i class="fa-solid fa-envelope"></i></span>
                    <span>actionsocialegvas@gmail.com</span>
                </a>
                <a href="https://www.google.com/maps/place/Groupe+Vision+D'aigle+Services/@-4.822363,11.9054355,68m/data=!3m1!1e3!4m6!3m5!1s0x1a60af0b2c6b78c9:0xc598de43a114b8f5!8m2!3d-4.8224261!4d11.9054924!16s%2Fg%2F11npdsmz7k?entry=ttu&g_ep=EgoyMDI2MDYxMy4wIKXMDSoASAFQAw%3D%3D"
                    target="_blank" class="fab-item">
                    <span class="footer-contact-item">
                        <span class="contact-icon"> <i class="fa-solid fa-location-dot"></i></span>
                        <span> Mpaka x-or Pointe-Noire, Congo </span>
                    </span>
                </a>
            </div>
            <div class="footer-divider"></div>
            <div class="footer-bottom">
                <button class="btn-partenaires" id="ouvrirPartenaires">
                    Voir nos partenaires
                </button>

                <div class="partners-overlay" id="partnersOverlay">

                    <div class="partners-circle">

                        <!-- Bouton fermer -->
                        <button class="partners-close" id="fermerPartenaires">
                            <i class="fa-solid fa-xmark"></i>
                        </button>

                        <h2>Nos partenaires</h2>

                        <div class="partners-carousel">

                            <div class="partner-track">

                                <!-- Partenaire 1 -->
                                <div class="partner-item">
                                    <div class="partner-logo">
                                        <a href="">
                                            <img src="../../Vika/images/Partenaires/AJEC.png"
                                                alt="AJEC"></a>
                                    </div>
                                    <span>AJEC</span>
                                </div>

                                <!-- Partenaire 2 -->
                                <div class="partner-item">
                                    <div class="partner-logo">
                                        <a href="">
                                            <img src="../../Vika/images/Partenaires/MZ.jpeg"
                                                alt="MZ Services"></a>
                                    </div>
                                    <span>MZ Services</span>
                                </div>

                                <!-- Partenaire 3 -->
                                <div class="partner-item">
                                    <div class="partner-logo">
                                        <a href="">
                                            <img src="../../Vika/images/Partenaires/cvmc.png"
                                                alt="CVMC"></a>
                                    </div>
                                    <span>cvmc</span>
                                </div>

                                <!-- Partenaire 4 -->

                                <div class="partner-item">
                                    <div class="partner-logo">
                                        <a href="">
                                            <img src="../../Vika/images/Partenaires/VIP.png"
                                                alt="VIP"></a>
                                    </div>
                                    <span>VIP</span>
                                </div>

                                <!-- Partenaire 5 -->
                                <div class="partner-item">
                                    <div class="partner-logo">
                                        <a href="">
                                            <img src="../../Vika/images/Partenaires/Ecole.png"
                                                alt="École"></a>
                                    </div>
                                    <span>École</span>
                                </div>

                                <!-- Partenaire 6 -->
                                <div class="partner-item">
                                    <div class="partner-logo">
                                        <a href="">
                                            <img src="../../Vika/images/Partenaires/feelec.jpeg"
                                                alt="FEELEC"></a>
                                    </div>
                                    <span>FEELEC</span>
                                </div>


                            </div>

                        </div>

                    </div>

                </div>
            </div>
    </footer>

    <style>
        .footer-modern {
            position: relative;

            overflow: hidden;

            margin: 18px 20px 15px;

            color: #fff;

            border-radius: 24px;

            border: 1px solid rgba(255, 255, 255, .13);

            background:
                radial-gradient(circle at 8% 50%,
                    rgba(105, 200, 62, .14),
                    transparent 28%),
                radial-gradient(circle at 92% 15%,
                    rgba(30, 120, 190, .18),
                    transparent 30%),
                linear-gradient(135deg,
                    #04172d 0%,
                    #082b4a 55%,
                    #061d38 100%);

            box-shadow:
                0 18px 45px rgba(0, 0, 0, .20),
                0 4px 15px rgba(0, 0, 0, .08),
                inset 0 1px 0 rgba(255, 255, 255, .08);

            isolation: isolate;
        }


        /* =========================================================
   LUMIÈRE FOOTER
========================================================= */

        .footer-modern::before {
            content: "";

            position: absolute;

            width: 240px;
            height: 240px;

            right: -120px;
            top: -150px;

            border-radius: 50%;

            background:
                radial-gradient(circle,
                    rgba(105, 200, 62, .20),
                    transparent 68%);

            filter: blur(25px);

            pointer-events: none;

            z-index: -1;
        }

        .footer-modern::after {
            content: "";

            position: absolute;

            width: 180px;
            height: 180px;

            left: -100px;
            bottom: -120px;

            border-radius: 50%;

            background:
                radial-gradient(circle,
                    rgba(20, 110, 190, .16),
                    transparent 70%);

            filter: blur(20px);

            pointer-events: none;

            z-index: -1;
        }


        /* =========================================================
   CONTENEUR FOOTER
========================================================= */

        .footer-modern-inner {
            width: min(1180px, 92%);

            margin: auto;
        }


        /* =========================================================
   PARTIE PRINCIPALE FOOTER
========================================================= */

        .footer-main {
            min-height: 100px;

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 30px;
        }


        /* =========================================================
   IDENTITÉ
========================================================= */

        .footer-identity {
            display: flex;

            align-items: center;

            gap: 11px;

            flex-shrink: 0;
        }


        /* =========================================================
   LOGO FOOTER
========================================================= */

        .footer-logo {
            width: 60px;
            height: 60px;

            display: flex;

            align-items: center;
            justify-content: center;

            padding: 4px;

            border-radius: 14px;

            background: #4e4d4d;

            border: 1px solid rgba(255, 255, 255, .5);

            box-shadow:
                0 7px 15px rgba(0, 0, 0, .25),
                0 0 0 3px rgba(105, 200, 62, .05);

            transition:
                transform .3s ease,
                box-shadow .3s ease;
        }

        .footer-logo img {
            width: 100%;
            height: 100%;

            object-fit: contain;

            border-radius: 10px;

            display: block;
        }

        .footer-logo:hover {
            transform:
                translateY(-3px) rotate(-2deg);

            box-shadow:
                0 11px 22px rgba(0, 0, 0, .3),
                0 0 20px rgba(105, 200, 62, .16);
        }


        /* =========================================================
   NOM GVAS FOOTER
========================================================= */

        .footer-identity strong {
            display: block;

            font-family: "Montserrat", sans-serif;

            font-size: 19px;

            font-weight: 800;

            letter-spacing: 1.8px;

            line-height: 1;
        }

        .footer-identity span {
            display: block;

            margin-top: 5px;

            color: #72c94b;

            font-size: 8px;

            font-weight: 700;

            letter-spacing: 1.4px;

            text-transform: uppercase;

            line-height: 1.3;
        }


        /* =========================================================
   NAVIGATION FOOTER
========================================================= */

        .footer-nav {
            display: flex;

            align-items: center;

            justify-content: center;

            gap: 15px;
        }

        .footer-nav a {
            position: relative;

            color: rgba(255, 255, 255, .65);

            font-size: 20px;

            font-weight: 600;

            text-decoration: none;

            white-space: nowrap;

            transition:
                color .25s ease,
                transform .25s ease;
        }

        .footer-nav a::after {
            content: "";

            position: absolute;

            left: 50%;
            bottom: -7px;

            width: 0;
            height: 2px;

            border-radius: 10px;

            background: #6bc83f;

            transform: translateX(-50%);

            transition: width .25s ease;
        }

        .footer-nav a:hover {
            color: #fff;

            transform: translateY(-1px);
        }

        .footer-nav a:hover::after {
            width: 100%;
        }


        /* =========================================================
   RÉSEAUX SOCIAUX
========================================================= */

        .footer-social {
            display: flex;

            align-items: center;

            gap: 7px;

            flex-shrink: 0;
        }

        .footer-social a {
            width: 38px;
            height: 38px;

            display: grid;

            place-items: center;

            border-radius: 10px;

            color: #fff;

            font-size: 17px;

            font-weight: 800;

            text-decoration: none;

            background:
                linear-gradient(145deg,
                    rgba(255, 255, 255, .12),
                    rgba(255, 255, 255, .035));

            border: 1px solid rgba(255, 255, 255, .13);

            box-shadow:
                inset 0 1px 0 rgba(255, 255, 255, .08),
                0 4px 10px rgba(0, 0, 0, .12);

            transition:
                transform .25s ease,
                background .25s ease,
                box-shadow .25s ease;
        }

        .footer-social a:hover {
            transform: translateY(-3px);

            background:
                linear-gradient(145deg,
                    #6bc83f,
                    #348f46);

            border-color: rgba(105, 200, 62, .6);

            box-shadow:
                0 7px 16px rgba(105, 200, 62, .22);
        }


        /* =========================================================
   CONTACT FOOTER
========================================================= */

        .footer-contact {
            min-height: 55px;

            display: flex;

            align-items: center;

            justify-content: center;

            gap: 38px;

            padding: 10px 0;

            border-top: 1px solid rgba(255, 255, 255, .08);
        }

        .footer-contact-item {
            display: flex;

            align-items: center;

            gap: 8px;

            color: rgba(255, 255, 255, .55);

            font-size: 13px;

            text-decoration: none;

            white-space: nowrap;

            transition:
                color .25s ease,
                transform .25s ease;
        }

        .footer-contact-item:hover {
            color: #6bc83f;

            transform: translateY(-1px);
        }

        .contact-icon {
            width: 30px;
            height: 30px;

            display: grid;

            place-items: center;

            border-radius: 8px;

            color: #6bc83f;

            font-size: 13px;

            background:
                rgba(105, 200, 62, .08);

            border: 1px solid rgba(105, 200, 62, .12);
        }


        /* =========================================================
   DIVIDER
========================================================= */

        .footer-divider {
            height: 1px;

            display: block;

            background:
                linear-gradient(90deg,
                    transparent,
                    rgba(255, 255, 255, .14),
                    transparent);
        }


        /* =========================================================
   BAS DU FOOTER
========================================================= */

        .footer-bottom {
            min-height: 55px;

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 20px;

            color: rgba(255, 255, 255, .38);

            font-size: 10px;
        }


        /* =========================================================
   SLOGAN
========================================================= */

        .footer-slogan {
            color: rgba(255, 255, 255, .52);

            font-family: Georgia, serif;

            font-style: italic;

            font-size: 11px;

            letter-spacing: .2px;
        }


        /* =========================================================
   ANIMATION REVEAL
========================================================= */

        .reveal {
            opacity: 0;

            transform: translateY(25px);

            transition: .7s ease;
        }

        .reveal.visible {
            opacity: 1;

            transform: none;
        }


        /* =========================================================
   TABLETTE
========================================================= */

        @media (max-width: 1000px) {

            .actions-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .mission-grid,
            .values-inner {
                gap: 45px;
            }
        }


        /* =========================================================
   TABLETTE / PETIT ÉCRAN
========================================================= */

        @media (max-width: 950px) {

            .footer-main {
                min-height: auto;

                padding: 24px 0;

                flex-wrap: wrap;

                justify-content: center;
            }

            .footer-nav {
                order: 3;

                width: 100%;

                flex-wrap: wrap;

                gap: 12px 20px;
            }

            .footer-contact {
                flex-wrap: wrap;

                gap: 15px 25px;
            }
        }


        /* =========================================================
   MOBILE 800px
========================================================= */

        @media (max-width: 800px) {

            .hero-content {
                margin-top: 40px;
            }

            .hero h1 {
                letter-spacing: -2px;
            }

            .mission-grid,
            .values-inner {
                grid-template-columns: 1fr;
            }

            .mission-card {
                min-height: auto;
            }

            .stat:nth-child(2) {
                border-right: 0;
            }

            .stat:nth-child(-n + 2) {
                border-bottom: 1px solid var(--line);
            }

            .news-grid {
                grid-template-columns: 1fr;
            }

            .footer-main,
            .footer-bottom {
                flex-direction: column;

                align-items: center;

                text-align: center;
            }
        }


        /* =========================================================
   MOBILE 768px
========================================================= */

        @media (max-width: 768px) {

            .footer-modern {
                margin: 12px;

                border-radius: 18px;
            }

            .footer-main {
                padding: 22px 0;

                gap: 20px;
            }

            .footer-identity {
                width: 100%;

                justify-content: center;
            }

            .footer-logo {
                width: 48px;
                height: 48px;
            }

            .footer-nav {
                width: 100%;

                gap: 10px 18px;
            }

            .footer-nav a {
                font-size: 12px;
            }

            .footer-social {
                width: 100%;

                justify-content: center;
            }

            .footer-contact {
                height: auto;

                min-height: auto;

                flex-direction: column;

                align-items: stretch;

                gap: 10px;

                padding: 15px 0;
            }

            .footer-contact-item {
                width: 100%;

                display: flex;

                align-items: center;

                gap: 10px;

                font-size: 13px;

                line-height: 1.5;

                white-space: normal;

                word-break: break-word;
            }

            .footer-contact-item .contact-icon {
                flex: 0 0 32px;

                width: 32px;
                height: 32px;

                display: flex;

                align-items: center;
                justify-content: center;
            }

            .footer-contact-item .contact-icon i {
                font-size: 15px;
            }

            .footer-bottom {
                min-height: auto;

                padding: 16px 0;

                flex-direction: column;

                justify-content: center;

                text-align: center;

                gap: 8px;
            }

            .footer-slogan {
                order: -1;

                font-size: 10px;
            }
        }


        /* =========================================================
   MOBILE 560px
========================================================= */

        @media (max-width: 560px) {

            .hero {
                min-height: 720px;
            }

            .hero p {
                font-size: 15px;
            }

            .hero-trust {
                margin-top: 38px;

                display: grid;

                grid-template-columns: 1fr 1fr;

                gap: 18px;
            }

            .hero-trust div,
            .hero-trust div:first-child {
                padding: 0;

                border-left: 0;
            }

            .hero-trust div:nth-child(3),
            .hero-trust div:nth-child(4) {
                border-top: 1px solid rgba(255, 255, 255, .16);

                padding-top: 14px;
            }

            .section {
                padding: 80px 5%;
            }

            .section-head h2,
            .values h2,
            .cta h2 {
                letter-spacing: -1.3px;
            }

            .actions-grid {
                grid-template-columns: 1fr;
            }

            .action-card {
                min-height: 330px;
            }

            .stat strong {
                font-size: 36px;
            }

            .scroll-indicator {
                display: none;
            }

            .footer-contact-item {
                font-size: 12px;
            }
        }


        /* =========================================================
   PETITS TÉLÉPHONES
========================================================= */

        @media (max-width: 480px) {

            .footer-modern {
                margin: 8px;
            }

            .footer-nav {
                gap: 10px 14px;
            }

            .footer-nav a {
                font-size: 10px;
            }

            .footer-identity strong {
                font-size: 17px;
            }

            .footer-identity span {
                font-size: 7px;
            }

            .footer-contact {
                gap: 10px;
            }

            .footer-contact-item {
                font-size: 12px;

                gap: 8px;
            }

            .footer-contact-item .contact-icon {
                flex: 0 0 30px;

                width: 30px;
                height: 30px;
            }

            .footer-contact-item .contact-icon i {
                font-size: 14px;
            }
        }


        /* =========================================================
   TRÈS PETITS TÉLÉPHONES
========================================================= */

        @media (max-width: 400px) {

            .footer-modern {
                margin: 6px;
            }

            .footer-nav {
                gap: 8px 12px;
            }

            .footer-nav a {
                font-size: 9px;
            }

            .footer-identity strong {
                font-size: 16px;
            }

            .footer-identity span {
                font-size: 7px;
            }
        }






        /* =========================================================
   BOUTON VOIR NOS PARTENAIRES
========================================================= */
        .btn-partenaires {
            display: block;
            width: fit-content;
            margin-left: auto;
            margin-right: auto;
            padding: 6px 18px;
            border: none;
            border-radius: 30px;
            background: #0c4c9180;
            color: white;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: .3s ease;
            box-shadow:
                0 8px 20px rgba(0, 0, 0, .20);
        }



        .btn-partenaires:hover {
            transform: translateY(-3px);
            background: #1d8f47;
            box-shadow:
                0 12px 25px rgba(0, 0, 0, .25);
        }


        /* =========================================================
   ARRIÈRE-PLAN DE LA FENÊTRE
========================================================= */

        .partners-overlay {
            position: fixed;
            inset: 0;
            z-index: 99999;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(0, 0, 0, .65);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            opacity: 0;
            visibility: hidden;
            transition:
                opacity .4s ease,
                visibility .4s ease;
        }


        .partners-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .partners-circle {
            position: relative;

            width: 700px;
            max-width: 90%;

            height: 250px;

            border-radius: 30px;

            display: flex;

            flex-direction: column;

            align-items: center;

            justify-content: center;

            /*
       On garde hidden ici afin que les logos
       restent à l'intérieur du rectangle.
    */
            overflow: hidden;

            background:
                linear-gradient(135deg,
                    rgba(255, 255, 255, 0.16),
                    rgba(255, 255, 255, 0.06));

            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);

            border: 1px solid rgba(255, 255, 255, 0.25);

            box-shadow:
                0 25px 70px rgba(0, 0, 0, 0.45),
                inset 0 1px 1px rgba(255, 255, 255, 0.25);

            transform:
                scale(.75) translateY(30px);

            transition:
                transform .6s cubic-bezier(.17, .67, .35, 1.25);
        }


        .partners-overlay.active .partners-circle {
            transform:
                scale(1) translateY(0);
        }

        .partners-circle::before {
            content: "";

            position: absolute;

            width: 250px;
            height: 250px;

            top: -120px;
            left: 10%;

            background: #1d8f47;

            filter: blur(100px);

            opacity: .25;

            pointer-events: none;
        }


        .partners-circle::after {
            content: "";

            position: absolute;

            width: 200px;
            height: 200px;

            right: -100px;
            bottom: -100px;

            background: #0c4c91;

            filter: blur(90px);

            opacity: .25;

            pointer-events: none;
        }


        .partners-circle h2 {
            position: relative;

            z-index: 5;

            margin: 0 0 20px;

            color: white;

            font-size: 26px;

            font-weight: 700;

            letter-spacing: 1px;

            text-align: center;

            text-shadow:
                0 3px 10px rgba(0, 0, 0, .3);
        }

        .partners-close {
            position: absolute;

            top: 18px;
            right: 20px;

            width: 42px;
            height: 42px;

            border: 1px solid rgba(255, 255, 255, .2);

            border-radius: 50%;

            background: rgba(255, 255, 255, .12);

            color: white;

            font-size: 28px;

            line-height: 1;

            cursor: pointer;

            z-index: 10;

            transition: .3s ease;

            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }

        .partners-close:hover {
            background: #e63946;

            transform:
                rotate(90deg) scale(1.1);
        }

        .partners-carousel {
            width: 100%;

            position: relative;

            z-index: 2;

            /*
       IMPORTANT :
       On ne met plus overflow:hidden ici.
       Cela empêchait le logo de monter lorsqu'on
       le survolait.
    */
            overflow: visible;

            padding-top: 12px;
            padding-bottom: 8px;

            /*
       Fondu uniquement visuel sur les côtés
    */
            mask-image:
                linear-gradient(to right,
                    transparent,
                    black 8%,
                    black 92%,
                    transparent);

            -webkit-mask-image:
                linear-gradient(to right,
                    transparent,
                    black 8%,
                    black 92%,
                    transparent);
        }

        .partner-track {
            display: flex;
            align-items: center;
            gap: 45px;
            width: max-content;
            animation:
                partnersMove 12s linear infinite;

            /*
       Permet au logo de dépasser légèrement
       pendant son hover.
    */
            padding-top: 8px;
            padding-bottom: 8px;

        }

        .partner-item {
            min-width: 130px;

            display: flex;

            flex-direction: column;

            align-items: center;

            justify-content: center;

            gap: 8px;

            color: white;

            text-align: center;

            position: relative;

            z-index: 3;
        }

        .partner-logo {
            width: 105px;
            height: 105px;

            flex-shrink: 0;

            border-radius: 50%;

            padding: 8px;

            background: rgba(255, 255, 255, .95);

            display: flex;

            align-items: center;
            justify-content: center;

            overflow: hidden;

            border: 3px solid rgba(255, 255, 255, .4);

            box-shadow:
                0 10px 25px rgba(0, 0, 0, .25),

                inset 0 1px 2px rgba(255, 255, 255, .8);

            transition:
                transform .3s ease,
                border-color .3s ease,
                box-shadow .3s ease;

            position: relative;

            z-index: 5;
        }

        .partner-logo:hover {
            /*
       Réduit légèrement le déplacement vers le haut
       pour éviter la coupure.
    */
            transform:
                scale(1.08) translateY(-3px);

            border-color: #69c83e;

            box-shadow:
                0 15px 30px rgba(0, 0, 0, .35);
        }


        .partner-logo img {
            width: 100%;
            height: 100%;

            object-fit: contain;

            border-radius: 50%;

            display: block;
        }


        .partner-item span {
            font-size: 14px;

            font-weight: 600;

            color: rgba(255, 255, 255, .95);

            white-space: nowrap;

            text-shadow:
                0 2px 5px rgba(0, 0, 0, .4);

            position: relative;

            z-index: 5;
        }

        @keyframes partnersMove {

            0% {
                transform: translateX(-50%);
            }

            100% {
                transform: translateX(20%);
            }
        }


        .partners-carousel:hover .partner-track {
            animation-play-state: paused;
        }


        @media (max-width: 768px) {

            .partners-circle {
                width: 90%;

                height: 350px;

                border-radius: 25px;
            }


            .partners-circle h2 {
                font-size: 22px;

                margin-bottom: 25px;
            }


            .partners-carousel {
                padding-top: 15px;
                padding-bottom: 10px;
            }


            .partner-logo {
                width: 90px;
                height: 90px;
            }


            .partner-item {
                min-width: 115px;
            }


            .partner-track {
                gap: 30px;

                padding-top: 8px;
                padding-bottom: 8px;
            }
        }

        @media (max-width: 600px) {

            .partners-circle {
                width: 90%;

                height: 330px;

                border-radius: 24px;
            }


            .partners-circle h2 {
                font-size: 20px;

                margin-bottom: 20px;
            }


            .partners-carousel {
                padding-top: 15px;
                padding-bottom: 10px;
            }


            .partner-logo {
                width: 75px;
                height: 75px;

                padding: 6px;

                border-width: 2px;
            }


            .partner-item {
                min-width: 95px;

                gap: 8px;
            }


            .partner-item span {
                font-size: 11px;
            }


            .partner-track {
                gap: 25px;

                padding-top: 8px;
                padding-bottom: 8px;
            }


            .partners-close {
                width: 35px;
                height: 35px;

                top: 15px;
                right: 15px;

                font-size: 23px;
            }
        }


        @media (max-width: 400px) {

            .partners-circle {
                width: 94%;

                height: 300px;
            }


            .partners-circle h2 {
                font-size: 18px;
            }


            .partners-carousel {
                padding-top: 12px;
            }


            .partner-logo {
                width: 65px;
                height: 65px;
            }


            .partner-item {
                min-width: 85px;
            }


            .partner-item span {
                font-size: 10px;
            }
        }
    </style>

</body>


<script>
    const ouvrirPartenaires =
        document.getElementById(
            "ouvrirPartenaires"
        );


    const fermerPartenaires =
        document.getElementById(
            "fermerPartenaires"
        );


    const partnersOverlay =
        document.getElementById(
            "partnersOverlay"
        );

    ouvrirPartenaires?.addEventListener(
        "click",
        (event) => {

            event.preventDefault();

            partnersOverlay?.classList.add(
                "active"
            );

        }
    );

    fermerPartenaires?.addEventListener(
        "click",
        () => {

            partnersOverlay?.classList.remove(
                "active"
            );

        }
    );

    partnersOverlay?.addEventListener(
        "click",
        (event) => {

            if (
                event.target === partnersOverlay
            ) {

                partnersOverlay.classList.remove(
                    "active"
                );

            }

        }
    );


    document.addEventListener(
        "keydown",
        (event) => {

            if (
                event.key === "Escape" &&
                partnersOverlay?.classList.contains("active")
            ) {

                partnersOverlay.classList.remove(
                    "active"
                );

            }

        }
    );
</script>
