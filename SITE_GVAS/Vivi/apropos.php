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
<!doctype html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="De réfférence, GVAS est une structure 
          professionnelle composée d’un personnel de qualité agréé 
          par l’État. spécialisé dans la vente des produits et services, 
          l'accompagnement professionnelle à travers des formations qualifiantes
           et certifiantes mais aussi
           dans un suivi quelconque en vue d’un domaine professionnel donné.">
  <meta name="author" content="Mr El-mavic BAKALA">
  <meta name="author" content="Miss Célina LUEMBA">
  <meta name="author" content="Gln93/Mr Tokyo">
  <meta name="robots" content="index, follow">
  <meta name="keywords"
    content="GVAS, EVGS, groupe vision d'aigle services, vision d'aigle, achat, formation, cours en ligne, produits, service">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;900&family=Lora:ital@0;1&display=swap" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
    integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- <link rel="stylesheet" href="../style.css"> -->
  <link rel="stylesheet" href="apropos.css">
  <link rel="icon" href="../images/Images/GVAS.png">
  <link rel="stylesheet" href="../Gloire/Assets/Css/style.css">
  <link rel="stylesheet" href="../Gloire/Assets/Css/stilisation.css">

  <title>à propos</title>
</head>

<body>

  <div class=" burger-menu ">
    <ul class=" links">
      <li><a href="../index.php">Accueil</a></li>
      <li><a href="../Formation.php">Formations</a></li>
      <li><a href="..galerie.php">Galerie</a></li>
      <li><a href="../contacts.php">Contacts</a></li>
      <div class="divider"></div>
      <div class="buttons-burger-menu">
        <a class="action-button" href="../Gloire/page_publicitaire.php">Pub</a>
        <a class="action-button" href="../temoignage.php">Temoignage</a>
      </div>
    </ul>
  </div>
  <header id="ancre">

    <div class="navbar">
      <div class="logo">
        <img class="gvas" src="images/Images/GVAS.png" alt="GVAS">

      </div>

      <ul class="links">
        <li><a href="../index.php">Accueil</a></li>
        <li><a href="../Formation.php">Formations</a></li>
        <li><a href="../galerie.php">Galerie</a></li>
        <li><a href="../contacts.php">Contacts</a></li>
      </ul>
      <div class="buttons">
        <a class="action-button pro " href="../Gloire/page_publicitaire.php">Pub</a>
        <a class="action-button" href="../temoignage.php">Témoignages</a>
      </div>
      <div class="burger-menu-button">
        <i class="fa-solid fa-bars"></i>
      </div>
    </div>
  </header>
  <p class="texte">Groupe Vision d'Aigle Services </p>

  </div>


  <!-- SECTION HERROO -->

  <section class="hero">
    <div class="h-background"></div>
    <div class="h-overlay"></div>
    <div class="h-frame">
      <div class="h-line">
        <div class="h-manager "></div>
        <div class="h-content">
          <h1>DISSIVOULOUD Sévérin</h1>
          <span>Manager de l'Entreprise</span>
          <p>
            Nous croyons en un monde où chaque personne a la possibilité de
            développer ses talents, de valoriser ses compétences et de construire
            un avenir meilleur grâce à l’accompagnement, à l’innovation et à des
            opportunités accessibles à tous.
          </p>
          <a href="#team">Découvrir notre équipe</a>
        </div>
      </div>
    </div>
  </section>

  <div class="content">
    <a href="#team">Notre Equipe</a>
    <!-- <a href='#manifestre" class="active" -->
    <a href="#histoire">Notre histoire</a>
    <a href="#chiffres">Chiffres clés</a>
    <a href="#partenaires">Nos partenaires</a>
  </div>

  <!-- partie des photos des subordonnés -->

  <section id="team" class="team-section">
    <h2 class="section-title">Notre Équipe</h2>
    <div class="team-carousel">
      <div class="team-card card-1">
        <img src="images/admin/Sev.png" alt="Président">
        <div class="team-content">
          <h2><span>DISSIVOULOUD Sévérin</span></h2>
          <h3>Président du GVAS</h3>
        </div>
      </div>

      <div class="team-card card-2">
        <img src="images/admin/tatiana.png" alt="Vice Présidente">
        <div class="team-content">
          <h2><span>DISSIVOULOUD Tatchiana</span></h2>
          <h3>Vice Présidente</h3>
        </div>
      </div>

      <div class="team-card card-3">
        <img src="images/admin/El.png" alt="Informatique">
        <div class="team-content">
          <h2><span>Mr BAKALA El-Mavic De Marfred</span></h2>
          <h3>Responsable informatique et Technique</h3>
        </div>
      </div>

      <div class="team-card card-4">
        <img src="images/admin/Israel.png" alt="Superviseur">
        <div class="team-content">
          <h2><span>Mr NZAOU MAFOUA Israel</span></h2>
          <h3>Responsable Marketing et commercial</h3>
        </div>
      </div>

      <div class="team-card card-5">
        <img src="images/admin/Bénie.png" alt="Sécrétaire">
        <div class="team-content">
          <h2><span>Mme NGOUALA Bénie</span></h2>
          <h3>Secrétaire administrative & Coordinatrice pédagogique</h3>
        </div>
      </div>

      <div class="team-card card-6">
        <img src="images/admin/komp.png" alt="Comptable">
        <div class="team-content">
          <h2><span>Mme KOMPANI Suza</span></h2>
          <h3>Secrétaire caissière</h3>
        </div>
      </div>

      <div class="team-card card-7">
        <img src="images/admin/ruth.png" alt="communication">
        <div class="team-content">
          <h2><span>Mme Ruth</span></h2>
          <h3>Secrétaire chargée de communication</h3>
        </div>
      </div>
      <div class="team-card card-8">
        <img src="images/admin/christ.png" alt="anglais">
        <div class="team-content">
          <h2><span>Mr NGOUNDIABAHOU Christ</span></h2>
          <h3>Responsable de la langue Anglaise</h3>
        </div>
      </div>
    </div>
  </section>

  <!-- Histoire de GVAS -->

  <section id="histoire" class="histoire-section">
    <div class="histoire-inner">
      <h2 class="section-title">Notre histoire</h2>
      <div class="timeline">
        <div class="timeline-item">
          <div class="timeline-dot"></div>
          <div class="timeline-date">Mai 2022</div>
          <div class="timeline-text">
            Fondation de G.V.A.S — Groupe Vision d'Aigle Services. Début des
            activités avec la vente de produits alimentaires et divers.
          </div>
        </div>
        <div class="timeline-item">
          <div class="timeline-dot"></div>
          <div class="timeline-date">Juin 2022</div>
          <div class="timeline-text">
            Intégration des services informatiques et de la formation. Mise en
            place d'un nouveau logo et d'une charte graphique.
          </div>
        </div>
        <div class="timeline-item">
          <div class="timeline-dot"></div>
          <div class="timeline-date">Juin 2023</div>
          <div class="timeline-text">
            Lancement de la première édition des formations « promo-vacances »
            en informatique et en anglais.
          </div>
        </div>
        <div class="timeline-item">
          <div class="timeline-dot"></div>
          <div class="timeline-date">Novembre 2023</div>
          <div class="timeline-text">
            Extension et rénovation du local. Acquisition d'un lot d'ordinateurs
            pour améliorer la qualité des formations.
          </div>
        </div>
        <div class="timeline-item">
          <div class="timeline-dot"></div>
          <div class="timeline-date">2024</div>
          <div class="timeline-text">
            Obtention du NUI, lancement de la 2ème édition promo-vacances,
            cérémonie de clôture à la salle Ivan Mamingui.
          </div>
        </div>
        <div class="timeline-item">
          <div class="timeline-dot"></div>
          <div class="timeline-date">2026</div>
          <div class="timeline-text">
            Poursuite de la Vision d'Aigle
          </div>
        </div>
      </div>
  </section>

  <!-- Les chiffres clés de GVAS -->

  <section id="chiffres" class="chiffres-section">
    <div class="chiffres-inner">
      <h2 class="section-title">Chiffres clés</h2>

      <div class="chiffres-grid">
        <div class="chiffres-card">
          <span class="chiffres-number">2022</span>
          <div class="chiffres-label">Année de fondation</div>
        </div>

        <a href="../galerie.php">
          <div class="chiffres-card">
            <span class="chiffres-number">+30</span>
            <div class="chiffres-label">étudiants formés</div>
          </div>
        </a>
        <a href="../Formation.php">
          <div class="chiffres-card">
            <span class="chiffres-number">+6</span>
            <div class="chiffres-label">Domaines de formation</div>
          </div>
        </a>
      </div>
    </div>
    <style>
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
        padding: 0 8em;
        background-color: #262828;
        border-bottom-left-radius: 50px;
        border-top-left-radius: 50px;
        border-bottom-right-radius: 50px;
        border-top-right-radius: 50px;
        display: flex;
        justify-content: flex-start;
        justify-content: center;
        align-items: center;
        height: 13vh;
      }

      .btn-container {
        display: flex;
        justify-content: flex-start;
        justify-content: center;
        align-items: center;
        margin-top: 40px;

      }

      .navbar {
        justify-content: space-between;
        width: auto;
      }

      .navbar .links a {
        position: relative;
      }

      .navbar .links a::after {
        content: "";
        position: absolute;
        left: 0;
        bottom: -5px;
        width: 0;
        height: 3px;
        background-color: #fff200;
        transition: width 0.3s ease;
      }

      .navbar .links a:hover::after {
        width: 100%;
      }

      .navbar {
        width: 100%;
        max-width: 1200px;
        height: 80px;
        margin: 0;
        display: flex;
        align-items: center;
        justify-content: space-between;
      }

      .gvas {
        width: 6.5%;
        position: absolute;
        left: 1%;
        margin-top: -3.2%;
      }

      .navbar .logo a {
        font-size: 1.5rem;
        font-weight: bold;
      }

      .navbar .links {
        display: flex;
        gap: 5rem;

      }


      .navbar .burger-menu-button {
        color: white;
        font-size: 1.5rem;
        cursor: pointer;
        display: none;
      }

      .buttons {
        display: flex;
        gap: 10px;
      }

      .action-button {
        background-color: #fff200;
        color: black;
        border: 1px solid #fff200;
        padding: 0.5rem 1.2rem;
        outline: none;
        border-radius: 5px;
        font-size: 0.9rem;
        font-weight: bold;
        cursor: pointer;

      }

      .action-button:hover {
        color: blue;
        border: 1px solid #fff200;
      }

      .pro {
        background-color: transparent;
        color: white;
        border: 1px solid #fff200;
      }

      .pro:hover {
        background-color: #fff200;
        color: rgba(34, 7, 97, 0.726);
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
        height: 250px;
        display: block;
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

      .buttons-burger-menu {
        display: flex;
        flex-direction: column;
        margin-left: -5px;
        gap: 10px;
      }

      /*------Suite----*/


      .texte {
        font-size: 3em;
        font-weight: bold;
        align-items: center;
        text-align: center;
        background: linear-gradient(90deg, #7c7f80, #fffb0096);
        font-family: Dutch801 XBd BT;
        width: 100%;
        height: auto;

      }

      .Table {
        margin-left: 90px;
      }

      .table1 {
        width: 13rem;
        height: 13rem;
        margin-left: 30%;
        border-radius: 50%;
        object-fit: cover;
        margin-top: 90px;
        animation: zoom 2s infinite alternate-reverse;

      }

      @keyframes zoom {
        from {
          transform: scale(1);
        }

        to {
          transform: scale(1.2);
        }
      }

      .table2 {
        width: 13rem;
        height: 13rem;
        margin-left: 2%;
        border-radius: 50%;
        object-fit: cover;
        margin-top: -400px;
        animation: zoom 2s infinite alternate-reverse;
      }

      @keyframes zoom {
        from {
          transform: scale(1);
        }

        to {
          transform: scale(1.2);
        }
      }

      /*----------------------------- 1366px Responsive Pour la page de d'acceuil-----------------------------------------------------*/


      @media (max-width: 1366px) {
        .Table {
          margin-left: 80px;
        }

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

      }

      @media (min-width: 1366px) {
        .Table {
          margin-left: 10%;
        }

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

      }

      /*------------------------------------------- 1180px Responsive----------------------------------------*/
      @media (max-width: 1180px) {
        .burger-menu {
          z-index: 99999;
        }

        @media (min-width: 1180px) {
          .burger-menu {
            z-index: 99999;
          }
        }

        .burger-menu-button {
          background: black;
          margin-right: 1px;
          z-index: 9999;
        }

        .Table {
          margin-left: -20px;
          margin-top: -40px;
        }

        .table {
          margin-top: 30px;
          margin-left: 100px;
        }

        .table1 {
          width: 180px;
          height: 180px;
        }

        .table2 {
          width: 180px;
          height: 180px;
        }



        .texte {
          word-wrap: break-word;
          overflow-wrap: break-word;
        }

      }

      /*------------------------------------------- 990px Responsive----------------------------------------*/
      @media (max-width:990px) {
        header {
          background: none;
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

        .table1 {
          width: 8rem;
          height: 8rem;
          position: relative;
          right: 5rem;
        }

        .table2 {
          width: 8rem;
          height: 8rem;
          position: relative;
          left: -5rem;
        }

        .texte {
          font-size: 2rem;
        }

      }

      /*------------------------------------------- 768px Responsive----------------------------------------*/
      @media (max-width: 768px) {
        .table {
          margin-top: 30px;
          margin-left: 100px;
        }

        .Table {
          margin-left: -80px;
        }

        .table1 {
          width: 150px;
          height: 150px;
        }

        .table2 {
          width: 150px;
          height: 150px;
        }

        .btn-primary {
          margin-left: -40px;
        }



        .burger-menu-button {
          background: black;
          margin-right: 1px;
          z-index: 9999;
        }
      }

      /*------------------------------------------- 500px Responsive----------------------------------------*/
      @media (max-width:500px) {

        .gvas {
          width: 5rem;
          margin-top: -40px;
        }

        .burger-menu-button {

          position: relative;
          left: 5rem;
          z-index: 9999;
        }

        header {
          display: block;
        }

      }

      /*------------------------------------------- burger----------------------------------------*/
      @media (max-width:576px) {

        .burger-menu {
          position: block;
          z-index: 9999;
        }
      }

      /*------------------------------------------- 414 Responsive----------------------------------------*/
      @media (max-width: 414px) {
        .Table {
          margin-left: -19px;
          margin-top: -90px;
        }

        .table {
          margin-top: 40px;
          margin-left: 130px;
        }

        .table1 {
          width: 150px;
          height: 150px;
          left: 2px;
        }

        .table2 {
          width: 150px;
          height: 150px;
          right: 30px;
          margin-top: -180px;
        }

        .modal-content {
          width: 320px;
        }

        .options {
          left: 80px;
          width: 200px;
        }

      }
    </style>
  </section>


  <!-- Les partenaires de GVAS -->

  <section id="partenaires" class="partenaires-section">
    <h2 class="section-title">Nos partenaires</h2>
    <p class="partenaires-subtitle">Ils nous font confiance</p>

    <div class="carousel-wrapper">
      <div class="carousel-track">

        <a href="https://www.airtel.cg/" target="_blank" class="ajac">
          <div class="carousel-item">
            <img src="images/Partenaires/R.jpg" alt="logo airtel">
            <span>Airtel</span>
          </div>
        </a>

        <a class="ajac">
          <div class="carousel-item">
            <img src="images/Partenaires/AJEC.jpeg" alt="logo AJEC">
            <span>AJEC</span>
          </div>
        </a>

        <a class="ajac">
          <div class="carousel-item">
            <img src="images/Partenaires/cvmc.png" alt="logo CVMC">
            <span>CVMC</span>
          </div>
        </a>

        <a href="https://www.facebook.com/vipconsultscongob/" target="_blank" class="ajac">
          <div class="carousel-item">
            <img src="images/Partenaires/VIP.png" alt="logo VIP">
            <span>VIP-Consult</span>
          </div>
        </a>


        <a href="https://www.africabizinfo.com/fr-CG/private-school-la-maniguette" target="_blank" class="ajac">
          <div class="carousel-item">
            <img src="images/Partenaires/Ecole.png" alt="logo école">
            <span>La maniguette</span>
          </div>
        </a>
      </div>
    </div>
  </section>

 <!-- ici--------------- -->
 <style>
   @media (max-width: 820px)
   {
     #foot h1 {
       font-size: 15px;
      }
    }
    </style>
    <!-- ici--------------- -->


  <div id="foot">
    <a href="../notre_image.php">
      <h1>
        Afin de nous connaître un peu plus <i class="fa-solid fa-arrow-right"></i>
      </h1>

      <img src="../images/Images/image.jpg" alt="lien_retours">
    </a>
  </div>

  <!-- La partie footer -->
  <?php include '../footer.php'; ?>

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
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  <script>
    const navLinks = document.querySelectorAll(".content a")

    function setActiveLink() {
      let currentSelector = "";
      document.querySelectorAll("section").forEach((section) => {
        const sectionTop = section.offsetTop - 50;
        const sectionBottom = sectionTop +
          section.offsetHeight;
        if (window.scrollY >= sectionTop && window.scrollY < sectionBottom) {
          currentSection = section.getAttribute("id");
        }
      });

      navLinks.forEach((link) => {
        link.classList.remove("active");
        if (link.getAttribute("href").substring(1) === currentSection) {
          link.classList.add("active");
        }
      });

    }
    window.addEventListener("scroll", setActiveLink);
  </script>

</body>

</html>
<!-- Accueil formation, galerie, contact -->