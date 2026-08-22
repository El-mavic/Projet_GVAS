<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description"
    content="GVAS - Groupement des Volontaires pour l'Action Sociale. Éduquer, former, accompagner et protéger pour un avenir durable.">
  <title>GVAS — Groupement des Volontaires pour l'Action Sociale</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Montserrat:wght@600;700;800&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <!-- HEADER 3D -->
  <header class="header-3d" id="siteHeader">
    <div class="header-glow"></div>

    <a href="#accueil" class="brand-3d" aria-label="GVAS - Accueil">
      <div class="logo-3d">
        <img src="assets/logo.png" alt="Logo GVAS">
      </div>
      <div class="brand-text">
        <strong>GVAS</strong>
        <span>Action Sociale</span>
      </div>
    </a>

    <nav class="nav-3d" id="mainNav">
      <a href="../index.php">GVAS</a>
      <a href="#mission">Notre mission</a>
      <a href="#valeurs">Nos valeurs</a>
      <a href="#actualites">Actualités</a>

      <a href="mailto:actionsocialegvas@gmail.com" class="join-3d">
        <span>Nous rejoindre</span>
        <b>↗</b>
      </a>
    </nav>

    <button class="menu-3d" id="menuToggle" aria-label="Ouvrir le menu" aria-expanded="false">
      <span></span>
      <span></span>
      <span></span>
    </button>
  </header>

  <main>
    <!-- HERO VIDEO -->
    <section class="hero" id="accueil">

      <video class="hero-video" autoplay muted loop playsinline poster="assets/logo.png">

        <source src="assets/Mavic.mp4" type="video/mp4">

        Votre navigateur ne prend pas en charge la vidéo.
      </video>

      <div class="hero-overlay"></div>

      <div class="hero-content">
        <div class="eyebrow">
          <span></span> ONG • ENGAGEMENT • SOLIDARITÉ
        </div>

        <h1>Agir aujourd'hui<br><em>pour un avenir durable.</em></h1>

        <p>
          Le <strong>Groupement des Volontaires pour l'Action Sociale</strong>
          œuvre pour éduquer, former, accompagner et protéger les communautés
          afin de construire une société plus solidaire et plus inclusive.
        </p>

        <div class="hero-actions">
          <a href="#mission" class="btn btn-primary">Découvrir notre mission <span><i class="fa-solid fa-arrow-up-right-from-square"></i></span></a>
          <a href="#actions" class="btn btn-light">Voir nos actions</a>
        </div>

        <div class="hero-trust">
          <div><strong>01</strong><span>Éduquer</span></div>
          <div><strong>02</strong><span>Former</span></div>
          <div><strong>03</strong><span>Accompagner</span></div>
          <div><strong>04</strong><span>Protéger</span></div>
        </div>
      </div>

      <a class="scroll-indicator" href="#mission" aria-label="Défiler vers le bas">
        <span></span>
        <small>Découvrir</small>
      </a>
    </section>

    <!-- INTRO / MISSION -->
    <section class="section mission" id="mission">
      <div class="section-head reveal">
        <span class="section-tag">QUI SOMMES-NOUS ?</span>
        <h2>Une organisation engagée<br><em>au service de l'humain.</em></h2>
      </div>

      <div class="mission-grid">
        <div class="mission-copy reveal">
          <p class="lead">
            GVAS rassemble des volontaires qui mettent leur énergie,
            leurs compétences et leur engagement au service de l'action sociale.
          </p>
          <p>
            Notre approche place la personne au cœur de nos interventions.
            Nous travaillons avec les communautés, les partenaires et les acteurs
            locaux pour apporter des réponses concrètes aux défis sociaux,
            éducatifs et environnementaux.
          </p>
          <a href="#valeurs" class="text-link">En savoir plus sur GVAS <span><i class="fa-solid fa-arrow-up-right-from-square"></i></span></a>
        </div>

        <div class="mission-card reveal">
          <div class="card-icon">✦</div>
          <span>NOTRE VISION</span>
          <h3>Une communauté où chacun peut apprendre, grandir et vivre dignement.</h3>
          <div class="line"></div>
          <p>Ensemble pour un avenir durable.</p>
        </div>
      </div>
    </section>

    <!-- ACTIONS -->
    <section class="section actions-section" id="actions">
      <div class="section-head center reveal">
        <span class="section-tag">CE QUE NOUS FAISONS</span>
        <h2>Des actions concrètes,<br><em>un impact qui compte.</em></h2>
      </div>

      <div class="actions-grid">
        <article class="action-card reveal">
          <div class="action-number">01</div>
          <div class="action-icon">◈</div>
          <h3>Éduquer</h3>
          <p>Favoriser l'accès au savoir, à l'information et à l'éducation pour renforcer l'autonomie des communautés.
          </p>
          <a href="#contact">Découvrir <span><i class="fa-solid fa-arrow-up-right-from-square"></i></span></a>
        </article>

        <article class="action-card featured reveal">
          <div class="action-number">02</div>
          <div class="action-icon">◇</div>
          <h3>Former</h3>
          <p>Développer les compétences et créer des opportunités grâce à la formation et au renforcement des capacités.
          </p>
          <a href="#contact">Découvrir <span><i class="fa-solid fa-arrow-up-right-from-square"></i></span></a>
        </article>

        <article class="action-card reveal">
          <div class="action-number">03</div>
          <div class="action-icon">✧</div>
          <h3>Accompagner</h3>
          <p>Être aux côtés des personnes et des groupes vulnérables avec des actions adaptées à leurs besoins.</p>
          <a href="#contact">Découvrir <span><i class="fa-solid fa-arrow-up-right-from-square"></i></span></a>
        </article>

        <article class="action-card featured reveal">
          <div class="action-number">04</div>
          <div class="action-icon">♡</div>
          <h3>Protéger</h3>
          <p>Promouvoir la dignité, les droits, la sécurité et la protection des personnes au sein des communautés.</p>
          <a href="#contact">Découvrir <span><i class="fa-solid fa-arrow-up-right-from-square"></i></span></a>
        </article>
      </div>
    </section>

    <!-- VALEURS -->
    <section class="values" id="valeurs">
      <div class="values-inner">
        <div class="values-copy reveal">
          <span class="section-tag">NOS VALEURS</span>
          <h2>Notre engagement<br><em>guide chacune de nos actions.</em></h2>
          <p>
            Nous croyons que la solidarité devient réellement puissante
            lorsqu'elle se transforme en actions responsables, inclusives
            et durables.
          </p>
        </div>

        <div class="values-list">
          <div class="value reveal"><span>01</span>
            <div>
              <h3>Solidarité</h3>
              <p>Être présents les uns pour les autres.</p>
            </div>
          </div>
          <div class="value reveal"><span>02</span>
            <div>
              <h3>Dignité</h3>
              <p>Respecter chaque personne et son parcours.</p>
            </div>
          </div>
          <div class="value reveal"><span>03</span>
            <div>
              <h3>Engagement</h3>
              <p>Transformer nos convictions en actions.</p>
            </div>
          </div>
          <div class="value reveal"><span>04</span>
            <div>
              <h3>Durabilité</h3>
              <p>Construire des solutions utiles dans le temps.</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- CTA -->
    <section class="cta" id="contact">
      <div class="cta-content reveal">
        <span class="section-tag">REJOIGNEZ LE MOUVEMENT</span>
        <h2>Ensemble, faisons<br><em>grandir l'espoir.</em></h2>
        <p>Vous souhaitez soutenir nos actions, devenir volontaire ou collaborer avec GVAS ? Parlons-nous.</p>
        <div class="hero-actions">
          <a href="" class="btn btn-primary">Nous contacter <span>→</span></a>
          <a href="mailto:actionsocialegvas@gmail.com" class="btn btn-outline">Devenir volontaire</a>
        </div>
      </div>
    </section>
    <!-- ACTUALITES / PLACEHOLDER -->
    <section class="section news" id="actualites">
      <div class="section-head reveal">
        <span class="section-tag">ACTUALITÉS</span>
        <h2>Sur le terrain,<br><em>près des communautés.</em></h2>
      </div>

      <div class="news-grid">
        <article class="news-card reveal">
          <div class="news-image one">
            <img src="assets/image1.jpeg" alt="Actualité">
          </div>
          <div class="news-body"><small>ACTIVITÉ • 2026</small>
            <h3>Nos actions au cœur des communautés</h3>
            <p>Ajoutez ici vos dernières nouvelles, campagnes ou activités.</p><a href="#">Lire la suite →</a>
          </div>
        </article>
        <article class="news-card reveal">
          <div class="news-image two">
            <img src="assets/image.jpeg" alt="Actualité">
          </div>
          <div class="news-body"><small>PROJET • 2026</small>
            <h3>Construire ensemble des solutions durables</h3>
            <p>Présentez ici vos projets, résultats et témoignages.</p><a href="#">Lire la suite →</a>
          </div>
        </article>
        <article class="news-card reveal">
          <div class="news-image three">
            <img src="assets/image2.jpeg" alt="Actualité">
          </div>
          <div class="news-body"><small>ENGAGEMENT • 2026</small>
            <h3>Rejoindre une dynamique solidaire</h3>
            <p>Partagez ici les opportunités de bénévolat et de partenariat.</p><a href="#">Lire la suite →</a>
          </div>
        </article>
      </div>
    </section>
  </main>

  <!-- FOOTER MODERNE -->
  <footer class="footer-modern">
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
          <a href="#accueil">Accueil</a>
          <a href="#mission">Mission</a>
          <a href="#valeurs">Valeurs</a>
          <a href="#actualites">Actualités</a>

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

        <a href="tel:+242XXXXXXXXX" class="footer-contact-item">
          <span class="contact-icon"> <i class="fa-solid fa-phone"></i></span>
          <span>+242 05 755 44 00</span>
        </a>

        <a href="mailto:contact@gvas.cg" class="footer-contact-item">
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

        <span class="footer-slogan">
          Ensemble pour un avenir durable
        </span>
      </div>

    </div>
  </footer>
  <script src="script.js"></script>
</body>

</html>