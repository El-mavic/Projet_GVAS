/* =========================================================
   HEADER
========================================================= */

const header = document.getElementById("siteHeader");
const menuToggle = document.getElementById("menuToggle");
const mainNav = document.getElementById("mainNav");


/* =========================================================
   HEADER — EFFET AU SCROLL
========================================================= */

window.addEventListener("scroll", () => {

  header?.classList.toggle(
    "scrolled",
    window.scrollY > 40
  );

});


/* =========================================================
   MENU MOBILE
========================================================= */

function closeMobileMenu() {

  mainNav?.classList.remove("open");

  menuToggle?.setAttribute(
    "aria-expanded",
    "false"
  );

  document.body.classList.remove("menu-open");
}


function openMobileMenu() {

  mainNav?.classList.add("open");

  menuToggle?.setAttribute(
    "aria-expanded",
    "true"
  );

  document.body.classList.add("menu-open");
}


/* Bouton menu */

menuToggle?.addEventListener("click", (event) => {

  event.stopPropagation();

  if (mainNav?.classList.contains("open")) {

    closeMobileMenu();

  } else {

    openMobileMenu();

  }

});


/* Fermer en cliquant à l'extérieur */

document.addEventListener("click", (event) => {

  if (
    mainNav?.classList.contains("open") &&
    !mainNav.contains(event.target) &&
    !menuToggle?.contains(event.target)
  ) {

    closeMobileMenu();

  }

});


/* Fermer avec Échap */

document.addEventListener("keydown", (event) => {

  if (event.key === "Escape") {

    closeMobileMenu();

  }

});


/* Fermer le menu après avoir cliqué sur un lien */

document
  .querySelectorAll(".nav-3d a")
  .forEach(link => {

    link.addEventListener(
      "click",
      closeMobileMenu
    );

  });


/* =========================================================
   NAVIGATION ACTIVE
========================================================= */

const sections =
  document.querySelectorAll("main section[id]");

const navLinks =
  document.querySelectorAll(".nav-3d a");


const navObserver =
  new IntersectionObserver(
    (entries) => {

      entries.forEach(entry => {

        if (!entry.isIntersecting) {
          return;
        }

        navLinks.forEach(link => {

          link.classList.remove("active");

        });


        const current =
          document.querySelector(
            `.nav-3d a[href="#${entry.target.id}"]`
          );


        current?.classList.add("active");

      });

    },
    {
      rootMargin: "-35% 0px -55% 0px"
    }
  );


sections.forEach(section => {

  navObserver.observe(section);

});


/* =========================================================
   ANIMATION REVEAL
========================================================= */

const revealObserver =
  new IntersectionObserver(
    (entries, observer) => {

      entries.forEach(entry => {

        if (!entry.isIntersecting) {
          return;
        }

        entry.target.classList.add("visible");

        observer.unobserve(entry.target);

      });

    },
    {
      threshold: 0.12
    }
  );


document
  .querySelectorAll(".reveal")
  .forEach(element => {

    revealObserver.observe(element);

  });


/* =========================================================
   COMPTEURS
========================================================= */

const counters =
  document.querySelectorAll("[data-count]");


const counterObserver =
  new IntersectionObserver(
    (entries, observer) => {

      entries.forEach(entry => {

        if (!entry.isIntersecting) {
          return;
        }


        const element =
          entry.target;

        const target =
          Number(element.dataset.count);

        const duration = 1300;

        const start =
          performance.now();


        const tick = (now) => {

          const progress =
            Math.min(
              (now - start) / duration,
              1
            );


          const eased =
            1 -
            Math.pow(
              1 - progress,
              3
            );


          element.textContent =
            Math.floor(
              target * eased
            ).toLocaleString("fr-FR");


          if (progress < 1) {

            requestAnimationFrame(tick);

          }

        };


        requestAnimationFrame(tick);

        observer.unobserve(element);

      });

    },
    {
      threshold: 0.7
    }
  );


counters.forEach(counter => {

  counterObserver.observe(counter);

});


/* =========================================================
   VIDÉO HERO
========================================================= */

/*
   Si aucune vidéo n'est disponible,
   le poster du Hero reste visible.
*/

const video =
  document.querySelector(".hero-video");


video?.addEventListener("error", () => {

  video.style.display = "none";

});





/* =========================================================
   PARTENAIRES
========================================================= */

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


/* =========================================================
   OUVRIR LA FENÊTRE
========================================================= */

ouvrirPartenaires?.addEventListener(
  "click",
  (event) => {

    event.preventDefault();

    partnersOverlay?.classList.add(
      "active"
    );

  }
);


/* =========================================================
   FERMER AVEC LE X
========================================================= */

fermerPartenaires?.addEventListener(
  "click",
  () => {

    partnersOverlay?.classList.remove(
      "active"
    );

  }
);


/* =========================================================
   FERMER EN CLIQUANT SUR LE FOND
========================================================= */

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


/* =========================================================
   FERMER AVEC LA TOUCHE ÉCHAP
========================================================= */

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