    <!-- HEADER 3D -->
    <header class="header-3d" id="siteHeader">
        <div class="header-glow"></div>

        <a href="../index.php" class="brand-3d" aria-label="GVAS - Accueil">
            <div class="logo-3d">
                <img src="assets/logo.png" alt="Logo GVAS">
            </div>
            <div class="brand-text">
                <strong>GVAS</strong>
                <span>Action Sociale</span>
            </div>
        </a>

        <nav class="nav-3d" id="mainNav">
            <a href="../../ong.php">Accueil</a>
            <a href="../../Vika/index.html">Qui sommes-nous ?</a>
            <a href="../../vika/mission.html">Notre Mission</a>

            <a href="#footer" class="join-3d">
                <span>Contactez-nous</span>
                <b>↗</b>
            </a>
        </nav>

        <button class="menu-3d" id="menuToggle" aria-label="Ouvrir le menu" aria-expanded="false">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </header>
    <style>
        :root {
            --navy: #092b5c;
            --blue: #0d5bb5;
            --green: #178b3c;
            --lime: #62b936;
            --ink: #10233d;
            --muted: #637083;
            --white: #fff;
            --soft: #f4f7f5;
            --line: #e4e9e6;
            --shadow: 0 18px 50px rgba(7, 37, 76, .10);
            --radius: 22px;
        }

        body {
            font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
            color: var(--ink);
            background: black;
            line-height: 1.65;
            overflow-x: hidden;
        }

        .brand-3d {
            display: flex;
            align-items: center;
            gap: 12px;

            position: relative;
            z-index: 2;

            transform-style: preserve-3d;
            transition: transform .4s ease;

            text-decoration: none;
            /* enlève le soulignement */
        }

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


        /* =========================================================
   LUMIÈRE DU HEADER
========================================================= */

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


        /* =========================================================
   HEADER APRÈS SCROLL
========================================================= */

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


        /* =========================================================
   MARQUE / BRAND
========================================================= */

        .brand-3d {
            display: flex;
            align-items: center;
            gap: 12px;

            position: relative;
            z-index: 2;

            transform-style: preserve-3d;
            transition: transform .4s ease;
        }

        .brand-3d:hover {
            transform:
                perspective(700px) rotateY(-5deg) translateZ(8px);
        }


        /* =========================================================
   LOGO HEADER
========================================================= */

        .logo-3d {
            width: 58px;
            height: 58px;

            border-radius: 18px;
            padding: 4px;

            background: white;

            display: grid;
            place-items: center;

            position: relative;

            transform:
                perspective(500px) rotateX(4deg) translateZ(12px);

            box-shadow:
                0 10px 0 rgba(4, 30, 64, .35),
                0 18px 25px rgba(0, 0, 0, .25),
                inset 0 2px 2px rgba(255, 255, 255, .9);

            transition: .4s ease;
        }

        .logo-3d::before {
            content: "";

            position: absolute;
            inset: -2px;

            border-radius: 20px;

            background: linear-gradient(135deg,
                    #fff,
                    #63c43d,
                    #0c4c91);

            z-index: -1;
            filter: blur(.5px);
        }

        .logo-3d:hover {
            transform:
                perspective(500px) rotateX(0deg) rotateY(12deg) translateY(-4px) translateZ(20px);

            box-shadow:
                0 12px 0 rgba(4, 30, 64, .35),
                0 25px 35px rgba(0, 0, 0, .3);
        }

        .logo-3d img {
            width: 100%;
            height: 100%;

            object-fit: contain;
            border-radius: 14px;
        }


        /* =========================================================
   TEXTE DU LOGO
========================================================= */

        .brand-text {
            display: flex;
            flex-direction: column;

            line-height: 1;
            color: white;
        }

        .brand-text strong {
            font-family: "Montserrat", sans-serif;
            font-size: 25px;
            letter-spacing: 2px;

            text-shadow:
                0 2px 0 rgba(0, 0, 0, .25),
                0 5px 12px rgba(0, 0, 0, .2);
        }

        .brand-text span {
            margin-top: 6px;

            font-size: 12px;
            letter-spacing: 2px;
            text-transform: uppercase;

            color: rgba(255, 255, 255, .72);
        }


        /* =========================================================
   NAVIGATION HEADER
========================================================= */

        .nav-3d {
            display: flex;
            align-items: center;
            gap: 7px;

            position: relative;
            z-index: 3;
        }

        .nav-3d>a:not(.join-3d) {
            position: relative;

            padding: 13px 14px;
            border-radius: 12px;

            color: rgba(255, 255, 255, .88);

            font-size: 20px;
            font-weight: 600;

            transition: .3s ease;

            transform-style: preserve-3d;
        }

        .nav-3d>a:not(.join-3d):hover {
            color: white;

            background: rgba(255, 255, 255, .10);

            transform:
                translateY(-3px) translateZ(8px);

            box-shadow:
                0 8px 15px rgba(0, 0, 0, .12);
        }

        .nav-3d>a:not(.join-3d)::after {
            content: "";

            position: absolute;

            bottom: 5px;
            left: 14px;

            width: 0;
            height: 2px;

            border-radius: 10px;

            background: #69c83e;

            box-shadow:
                0 0 8px rgba(105, 200, 62, .8);

            transition: width .3s ease;
        }

        .nav-3d>a:not(.join-3d):hover::after,
        .nav-3d>a.active::after {
            width: calc(100% - 28px);
        }


        /* =========================================================
   BOUTON CONTACT
========================================================= */

        .join-3d {
            display: flex;
            align-items: center;
            gap: 10px;

            margin-left: 8px;
            padding: 12px 12px 12px 18px;

            border-radius: 15px;

            color: #082b5c;

            background: linear-gradient(145deg,
                    #fff,
                    #dff5d7);

            font-size: 12px;
            font-weight: 800;

            box-shadow:
                0 5px 0 #4d9630,
                0 10px 20px rgba(0, 0, 0, .20),
                inset 0 1px 2px white;

            transform:
                perspective(500px) translateZ(5px);

            transition: .25s ease;
        }

        .join-3d b {
            width: 27px;
            height: 27px;

            display: grid;
            place-items: center;

            border-radius: 9px;

            color: white;
            background: #0a4d8c;

            box-shadow:
                0 3px 0 #062c54;
        }

        .join-3d:hover {
            transform:
                perspective(500px) translateY(-4px) translateZ(15px);

            box-shadow:
                0 8px 0 #4d9630,
                0 18px 25px rgba(0, 0, 0, .25),
                inset 0 1px 2px white;
        }

        .join-3d:active {
            transform: translateY(2px);

            box-shadow:
                0 2px 0 #4d9630;
        }


        /* =========================================================
   MENU MOBILE
========================================================= */

        .menu-3d {
            display: none;

            width: 46px;
            height: 46px;

            border: 1px solid rgba(255, 255, 255, .2);
            border-radius: 14px;

            background: rgba(255, 255, 255, .1);

            cursor: pointer;

            box-shadow:
                0 8px 20px rgba(0, 0, 0, .15),
                inset 0 1px 1px rgba(255, 255, 255, .2);
        }

        .menu-3d span {
            display: block;

            width: 22px;
            height: 2px;

            margin: 4px auto;

            border-radius: 5px;

            background: white;

            transition: .3s ease;
        }


        /* =========================================================
   HEADER TABLETTE
========================================================= */

        @media (max-width: 1000px) {

            .nav-3d {
                gap: 2px;
            }

            .nav-3d>a:not(.join-3d) {
                padding: 12px 9px;
                font-size: 11px;
            }
        }


        /* =========================================================
   HEADER MOBILE
========================================================= */

        @media (max-width: 820px) {

            .header-3d {
                top: 10px;
                height: 68px;
                width: 94%;
                border-radius: 19px;
            }

            .menu-3d {
                display: block;
            }

            .nav-3d {
                position: fixed;

                top: 0;
                right: -100%;

                width: min(340px, 85%);
                height: 60vh;

                padding: 20px 30px 40px;

                display: flex;
                flex-direction: column;
                align-items: stretch;
                justify-content: flex-start;

                gap: 8px;

                background: linear-gradient(145deg,
                        rgba(5, 35, 72, .98),
                        rgba(5, 57, 71, .96));

                backdrop-filter: blur(25px);

                box-shadow:
                    -25px 0 60px rgba(0, 0, 0, .3);

                transition: .45s ease;

                border-radius: 20px;

                margin-top: 65px;
            }

            .nav-3d.open {
                right: 0;
            }

            .nav-3d>a:not(.join-3d) {
                padding: 17px;
                font-size: 14px;

                background: rgba(255, 255, 255, .04);
            }

            .join-3d {
                justify-content: center;

                margin: 12px 0 0;
                padding: 15px;
            }
        }


        /* =========================================================
   PETIT MOBILE HEADER
========================================================= */

        @media (max-width: 480px) {

            .brand-text span {
                display: none;
            }

            .brand-text strong {
                font-size: 18px;
            }

            .logo-3d {
                width: 50px;
                height: 50px;
            }
        }
    </style>

</body>

<script>
    const header = document.getElementById("siteHeader");
    const menuToggle = document.getElementById("menuToggle");
    const mainNav = document.getElementById("mainNav");

    window.addEventListener("scroll", () => {
        header?.classList.toggle("scrolled", window.scrollY > 40);
    });

    function closeMobileMenu() {
        mainNav?.classList.remove("open");
        menuToggle?.setAttribute("aria-expanded", "false");
        document.body.classList.remove("menu-open");
    }

    function openMobileMenu() {
        mainNav?.classList.add("open");
        menuToggle?.setAttribute("aria-expanded", "true");
        document.body.classList.add("menu-open");
    }
    menuToggle?.addEventListener("click", (event) => {
        event.stopPropagation();
        mainNav.classList.contains("open") ? closeMobileMenu() : openMobileMenu();
    });
    document.addEventListener("click", (event) => {
        if (mainNav?.classList.contains("open") && !mainNav.contains(event.target) && !menuToggle?.contains(event.target)) closeMobileMenu();
    });
    document.addEventListener("keydown", (event) => {
        if (event.key === "Escape") closeMobileMenu();
    });
    document.querySelectorAll(".nav-3d a").forEach(link => link.addEventListener("click", closeMobileMenu));

    const sections = document.querySelectorAll("main section[id]");
    const navLinks = document.querySelectorAll(".main-nav a");

    const navObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                navLinks.forEach(link => link.classList.remove("active"));
                const current = document.querySelector(`.main-nav a[href="#${entry.target.id}"]`);
                current?.classList.add("active");
            }
        });
    }, {
        rootMargin: "-35% 0px -55% 0px"
    });

    sections.forEach(section => navObserver.observe(section));

    const revealObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add("visible");
                observer.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.12
    });

    document.querySelectorAll(".reveal").forEach(el => revealObserver.observe(el));

    const counters = document.querySelectorAll("[data-count]");
    const counterObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (!entry.isIntersecting) return;

            const el = entry.target;
            const target = Number(el.dataset.count);
            const duration = 1300;
            const start = performance.now();

            const tick = now => {
                const progress = Math.min((now - start) / duration, 1);
                const eased = 1 - Math.pow(1 - progress, 3);
                el.textContent = Math.floor(target * eased).toLocaleString("fr-FR");
                if (progress < 1) requestAnimationFrame(tick);
            };

            requestAnimationFrame(tick);
            observer.unobserve(el);
        });
    }, {
        threshold: 0.7
    });

    counters.forEach(counter => counterObserver.observe(counter));

    // Si aucune vidéo n'est fournie, le poster du hero reste visible.
    const video = document.querySelector(".hero-video");
    video?.addEventListener("error", () => {
        video.style.display = "none";
    });
</script>

