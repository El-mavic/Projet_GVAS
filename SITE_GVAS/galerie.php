<?php
require 'traitement.php';

$req = $pdo->query("SELECT * FROM galerie ORDER BY id DESC");
$medias = $req->fetchAll();
?>

<!DOCTYPE html>
<html>

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
  <link rel="icon" href="images/Images/GVAS.png">
  <title>Groupe Vision d'Aigle Services</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <div class=" burger-menu ">
    <ul class=" links">
      <li><a href="index.php">Accueil</a></li>
      <li><a href="temoignage.php">Temoignage</a></li>
      <li><a href="Galerie.php">Galerie</a></li>
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

  <div class="gallery-grid">

    <?php foreach ($medias as $media): ?>

      <div class="gallery-item">

        <?php if ($media['type_media'] == 'image'): ?>

          <img src="<?= $media['chemin'] ?>"
            onclick="openViewer('<?= $media['chemin'] ?>')">

        <?php else: ?>

          <video onclick="openViewer('<?= $media['chemin'] ?>', true)">
            <source src="<?= $media['chemin'] ?>">
          </video>

        <?php endif; ?>

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

  <script src="assets/js/galerie.js"></script>
  <style>
    .gallery-grid {
      columns: 6;
      column-gap: 20px;
      padding: 20px;
    }

    .gallery-item {
      break-inside: avoid;
      margin-bottom: 20px;
      overflow: hidden;
      border-radius: 15px;
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

    /* =========================
   LIGHTBOX MODERNE
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

    #viewer.show {
      display: flex;
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
      box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
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

    /* NAV */
    .nav {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      width: 55px;
      height: 55px;
      border-radius: 50%;
      border: none;
      font-size: 28px;
      cursor: pointer;
      background: rgba(255, 255, 255, 0.9);
      transition: 0.2s;
    }

    .nav:hover {
      transform: translateY(-50%) scale(1.1);
      background: #fff;
    }

    .left {
      left: 20px;
    }

    .right {
      right: 20px;
    }

    /* CLOSE */
    #close {
      position: absolute;
      top: 20px;
      right: 25px;
      font-size: 35px;
      color: white;
      cursor: pointer;
    }
  </style>





  <script>
    let images = [];
    let currentIndex = 0;

    // OPEN LIGHTBOX
    function openViewer(src) {

      images = Array.from(document.querySelectorAll('.gallery-item img, .gallery-item video'));

      currentIndex = images.findIndex(el => {
        return el.getAttribute('data-src') === src || el.src === src;
      });

      if (currentIndex === -1) currentIndex = 0;

      showImage();

      document.getElementById("viewer").style.display = "flex";
    }

    // SHOW IMAGE / VIDEO
    function showImage() {

      const el = images[currentIndex];

      const src = el.getAttribute('data-src') || el.src;

      if (el.tagName === "IMG") {
        document.getElementById("viewerContent").innerHTML =
          `<img src="${src}" style="max-width:95%; max-height:95vh;">`;
      } else {
        document.getElementById("viewerContent").innerHTML =
          `<video controls autoplay style="max-width:95%; max-height:95vh;">
                <source src="${src}">
             </video>`;
      }
    }

    // NEXT
    function next() {
      if (!images.length) return;

      currentIndex = (currentIndex + 1) % images.length;
      showImage();
    }

    // PREV
    function prev() {
      if (!images.length) return;

      currentIndex = (currentIndex - 1 + images.length) % images.length;
      showImage();
    }

    // CLOSE
    function closeViewer() {
      document.getElementById("viewer").style.display = "none";
      document.getElementById("viewerContent").innerHTML = "";
    }

    // KEYBOARD
    document.addEventListener("keydown", (e) => {
      if (document.getElementById("viewer").style.display !== "flex") return;

      if (e.key === "Escape") closeViewer();
      if (e.key === "ArrowRight") next();
      if (e.key === "ArrowLeft") prev();
    });
  </script>
</body>

</html>