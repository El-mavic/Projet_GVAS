<?php
require 'traitement.php';

$req = $pdo->query("SELECT * FROM galerie ORDER BY id DESC");
$medias = $req->fetchAll();
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
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
    integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <meta name="description" content="De réfférence, GVAS est une structure professionnelle...">
  <meta name="author" content="Mr El-mavic BAKALA">
  <meta name="author" content="Miss Célina LUEMBA">
  <meta name="author" content="Gln93/Mr Tokyo">

  <meta name="robots" content="index, follow">
  <meta name="keywords" content="GVAS, EVGS, groupe vision d'aigle services">

  <link rel="icon" href="images/Images/GVAS.png">
  <title>Groupe Vision d'Aigle Services</title>
  <link rel="stylesheet" href="style.css">

</head>

<body>

  <!--------------------------------------------------------Header---------------------------------------------------------------->
  <div class="burger-menu ">
    <ul class="links">
      <li><a href="index.php">Accueil</a></li>
      <li><a href="temoignage.php">Temoignage</a></li>
      <li><a href="Formation.php">Formations</a></li>
      <li><a href="contacts.php">Contacts</a></li>
      <div class="divider"></div>
      <div class="buttons-burger-menu">
        <a class="action-button" href="Gloire/page_publicitaire.php">Pub</a>
        <a class="action-button" href="vivi/apropos.php">A propos</a>
      </div>
    </ul>
  </div>

  <header>

    <div class="navbar">
      <div class="logo">
        <img class="gvas" src="images/Images/GVAS.png" alt="GVAS">
      </div>


      <ul class="links">
        <li><a href="index.php">Accueil</a></li>
        <li><a href="temoignage.php">Temoignage</a></li>
        <li><a href="Formation.php">Formations</a></li>
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
  <!--------------------------------------Message de GVAS BIENVENUE---------------------------------------------------------------->

  <p class="texte">Bienvenue au Groupe Vision d'Aigle Services </p>
  <!-- GALERIE -->
  <div class="gallery-grid">

    <?php foreach ($medias as $media): ?>

      <div class="gallery-item">

        <div class="media-wrapper">

          <?php if ($media['type_media'] == 'image'): ?>

            <img src="<?= $media['chemin'] ?>" onclick="openViewer(this)">

          <?php else: ?>

            <video onclick="openViewer(this)">
              <source src="<?= $media['chemin'] ?>">
            </video>

          <?php endif; ?>

          <!-- TEXTE AU SURVOL -->
          <div class="overlay">
            <?= $media['titre'] ?? "GVAS" ?>
          </div>

        </div>

      </div>

    <?php endforeach; ?>

  </div>

  <!-- LIGHTBOX -->
  <div id="viewer">
    <span id="close" onclick="closeViewer()">✕</span>

    <button class="nav left" onclick="prev()">❮</button>
    <div id="viewerContent"></div>
    <button class="nav right" onclick="next()">❯</button>
  </div>
  <style>
    /* =========================
       GALERIE
    ========================= */
    body {
      background-color: rgb(68, 69, 70);
    }

    .gallery-grid {
      columns: 6;
      column-gap: 20px;
      padding: 20px;
    }

    .gallery-item {
      break-inside: avoid;
      margin-bottom: 20px;
      border-radius: 15px;
      overflow: hidden;
    }

    /* wrapper */
    .media-wrapper {
      position: relative;
      border-radius: 15px;
      overflow: hidden;
    }

    .gallery-item img,
    .gallery-item video {
      width: 100%;
      display: block;
      border-radius: 15px;
      cursor: pointer;
      transition: transform 0.25s ease, box-shadow 0.25s ease;
    }

    .gallery-item img:hover,
    .gallery-item video:hover {
      transform: scale(1.04);
      box-shadow: 0 15px 40px rgba(0, 0, 0, 0.35);
    }

    /* OVERLAY TEXTE */
    .overlay {
      position: absolute;
      bottom: 0;
      left: 0;
      right: 0;

      background: rgba(0, 0, 0, 0.6);
      color: white;
      text-align: center;

      padding: 10px;
      font-size: 14px;

      opacity: 0;
      transition: 0.3s ease;
    }

    .media-wrapper:hover .overlay {
      opacity: 1;
    }

    /* =========================
       LIGHTBOX
    ========================= */

    #viewer {
      display: none;
      position: fixed;
      inset: 0;
      background: rgba(0, 0, 0, 0.95);
      z-index: 9999;
      justify-content: center;
      align-items: center;
      backdrop-filter: blur(10px);
    }

    #viewerContent {
      width: 100%;
      height: 100%;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    #viewerContent img,
    #viewerContent video {
      max-width: 95%;
      max-height: 95vh;
      object-fit: contain;
      border-radius: 12px;
      animation: zoomIn 0.2s ease;
    }

    @keyframes zoomIn {
      from {
        transform: scale(0.85);
        opacity: 0;
      }

      to {
        transform: scale(1);
        opacity: 1;
      }
    }

    .nav {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      width: 40px;
      height: 40px;
      border-radius: 50%;
      border: none;
      font-size: 18px;
      cursor: pointer;
      background: rgb(111, 112, 110);
    }

    .left {
      left: 20px;
    }

    .right {
      right: 20px;
    }

    #close {
      position: absolute;
      top: 20px;
      right: 25px;
      font-size: 20px;
      color: white;
      cursor: pointer;
    }
  </style>
  <script>
    let images = [];
    let currentIndex = 0;

    function openViewer(el) {
      images = Array.from(document.querySelectorAll('.gallery-item img, .gallery-item video'));
      currentIndex = images.indexOf(el);
      showItem();
      document.getElementById("viewer").style.display = "flex";
    }

    function showItem() {
      const el = images[currentIndex];
      const src = el.querySelector ? el.querySelector("source")?.src || el.src : el.src;

      if (el.tagName === "IMG") {
        document.getElementById("viewerContent").innerHTML = `<img src="${src}">`;
      } else {
        document.getElementById("viewerContent").innerHTML = `<video controls autoplay><source src="${src}"></video>`;
      }
    }

    function next() {
      currentIndex = (currentIndex + 1) % images.length;
      showItem();
    }

    function prev() {
      currentIndex = (currentIndex - 1 + images.length) % images.length;
      showItem();
    }

    function closeViewer() {
      document.getElementById("viewer").style.display = "none";
      document.getElementById("viewerContent").innerHTML = "";
    }
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
</body>

</html>