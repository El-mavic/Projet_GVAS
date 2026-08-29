<style>
/* =========================================================
   HEADER 3D GVAS
========================================================= */

.header-3d {
  position: fixed;
  top: 18px;
  left: 50%;
  transform: translateX(-50%);
  width: min(1180px, 92%);
  height: 78px;
  z-index: 9999;

  display: flex;
  align-items: center;
  justify-content: space-between;

  padding: 8px 12px 8px 10px;

  border-radius: 24px;

  background: linear-gradient(135deg,
      rgba(255, 255, 255, .17),
      rgba(255, 255, 255, .06));

  border: 1px solid rgba(255, 255, 255, .28);

  backdrop-filter: blur(22px);
  -webkit-backdrop-filter: blur(22px);

  box-shadow:
    0 15px 35px rgba(0, 0, 0, .20),
    0 5px 10px rgba(0, 0, 0, .08),
    inset 0 1px 1px rgba(255, 255, 255, .30);

  perspective: 1000px;

  transition:
    width .4s ease,
    top .4s ease,
    height .4s ease,
    background .4s ease,
    box-shadow .4s ease;
}

.header-glow {
  position: absolute;
  width: 180px;
  height: 180px;
  top: -100px;
  left: 35%;

  background: #1d8f47;
  filter: blur(80px);
  opacity: .25;

  pointer-events: none;
}

.header-3d.scrolled {
  top: 10px;
  height: 70px;

  background: linear-gradient(135deg,
      rgba(5, 31, 67, .92),
      rgba(8, 52, 83, .82));

  box-shadow:
    0 20px 50px rgba(0, 0, 0, .32),
    inset 0 1px 1px rgba(255, 255, 255, .15);

  border-color: rgba(255, 255, 255, .15);
}
</style>


            <header class="header-3d" id="siteHeader">
                <div class="header-glow"></div>

                <a href="#accueil" class="brand-3d" aria-label="GVAS - Accueil">
                    <div class="logo-3d">
                        <img src="../src" alt="Logo GVAS">
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
