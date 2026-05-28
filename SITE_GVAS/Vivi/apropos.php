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
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;900&family=Lora:ital@0;1&display=swap" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
    integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="apropos.css">
  <link rel="icon" href="../images/Images/GVAS.png">
  <title>à propos</title>
</head>

<body>
  <nav>
    <div class="logo"><span>G.V.A.S</span></div>
    <button class="burger" id="burger">
      <span></span>
      <span></span>
      <span></span>
    </button>
    <ul class="liens" id="menu">
      <li><a href="../index.php">Accueil</a></li>
      <li><a href="../Formation.php">Formations</a></li>
      <li><a href="../Galerie.php">Galerie</a></li>
      <li><a href="../contacts.php">Contacts</a></li>
    </ul>
    <!-- <button class="bouton">Nous rejoindre</button> -->
    <a href="../Gloire/page_publicitaire.php" class="bouton">En savoir plus</a>
  </nav>

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
    <a href="#team" class="active">Notre Equipe</a>
    <!-- <a href='#manifestre" class="active" -->
    <a href="#histoire">Notre histoire</a>
    <a href="#chiffres">Chiffres clés</a>
    <a href="#partenaires">Nos partenaires</a>
  </div>

  <!-- partie des photos des subordonnés -->

  <div id="team" class="team-section">
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
        <img src="images/BG/17.JPG" alt="communication">
        <div class="team-content">
          <h2><span>Mme Ruth</span></h2>
          <h3>Secrétaire chargée de communication</h3>
        </div>
      </div>
      <div class="team-card card-8">
        <img src="images/admin/christ.png" alt=anglais">
        <div class="team-content">
          <h2><span>Mr NGOUNDIABAHOU Christ</span></h2>
          <h3>Responsable de la langue Anglaise</h3>
        </div>
      </div>
    </div>
  </div>

  <!-- Histoire de GVAS -->

  <div id="histoire" class="histoire-section">
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
    </div>

    <!-- Les chiffres clés de GVAS -->

    <div id="chiffres" class="chiffres-section">
      <div class="chiffres-inner">
        <h2 class="section-title">Chiffres clés</h2>

        <div class="chiffres-grid">
          <div class="chiffres-card">
            <span class="chiffres-number">2022</span>
            <div class="chiffres-label">Année de fondation</div>
          </div>

          <a href="Galerie.php">
            <div class="chiffres-card">
              <span class="chiffres-number">+30</span>
              <div class="chiffres-label">étudiants formés</div>
            </div>
          </a>


          <a href="../Formations.php">
            <div class="chiffres-card">
              <span class="chiffres-number">+6</span>
              <div class="chiffres-label">Domaines de formation</div>
            </div>
          </a>
        </div>
      </div>
    </div>

    <!-- Les partenaires de GVAS -->

    <div id="partenaires" class="partenaires-section">
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


      <!-- THE FOOTER -->
      <footer class="footer">
        <div class="footer-container">

          <!--  Logo + texte + réseaux -->

          <div class="footer-description">
            <img src="images/Images/GVAS.png" alt="Logo GVAS">
            <p class="footer-text">
              Le Groupe Vision d'Aigle Services accompagne les talents vers un avenir meilleur.
            </p>
            <!--<div class="footer-social">
            <div class="social-btn">
              <div class="social-item">
                <i class="fa-brands fa-facebook"></i>
                <span>Facebook</span>
              </div>
            </div>
          </div>-->
            <div class="footer-social">
              <a class="fb" href="https://www.facebook.com/profile.php?id=61583138888176" target="_blank">
                <ion-icon name="logo-facebook"></ion-icon>
              </a>
              <a class="fb" href="https://youtube.com/dcodeyt" target="_blank">
                <ion-icon name="logo-youtube"></ion-icon>
              </a>
              <!--  
              <a class="fb" href="https://instagram.com/dcodeyt" target="_blank">
                <ion-icon name="logo-instagram"></ion-icon>
              </a>
              -->
              <a class="fb" href="https://whatsapp.com/dcodeyt" target="_blank">
                <ion-icon name="logo-whatsapp"></ion-icon>
              </a>
              <a class="fb" href="https://tiktok.com/dcodeyt" target="_blank">
                <ion-icon name="logo-tiktok"></ion-icon>
              </a>
            </div>
          </div>

          <div class="footer-col">
            <h4>À propos</h4>
            <ul>
              <li><a href="apropos.php#histoire">Notre histoire</a></li>
              <li><a href="apropos.php#team">Notre équipe</a></li>
              <li><a href="apropos.php#chiffres">Chiffres clés</a></li>
              <li><a href="apropos.php#partenaires">Nos partenaires</a></li>
            </ul>
          </div>

          <div class="footer-col">
            <h4>Formations</h4>
            <ul>
              <li><a href="Formation.php">Nos programmes</a></li>
              <li><a href="index.php">Inscription</a></li>
              <li><a href="Gloire/page_publicitaire.php">En savoir plus sur nos services</a></li>
            </ul>
          </div>

          <div class="footer-encadre">
            <h4>Une question ?</h4>
            <p>Notre équipe est disponible pour répondre à toutes vos questions</p>
            <a href="../contacts.php" class="footer-encadre-btn">Contactez-nous</a>
            <a href="../temoignage.php" class="buton">Nos témoignages</a>
          </div>
        </div>
        <div class="footer-bottom">
          <p>© 2026 — <span>G.V.A.S</span> — Tous droits réservés à l'auteur.</p>
        </div>
      </footer>

      <script>
        const burger = document.getElementById('burger');
        const menu = document.getElementById('menu');

        burger.addEventListener('click', () => {
          burger.classList.toggle('active');
          menu.classList.toggle('open');
        });

        menu.querySelectorAll('a').forEach(link => {
          link.addEventListener('click', () => {
            burger.classList.remove('active');
            menu.classList.remove('open');
          });
        });

      </script>
      <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
      <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>
<!-- Accueil formation, galerie, contact -->