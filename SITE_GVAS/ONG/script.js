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
}, { rootMargin: "-35% 0px -55% 0px" });

sections.forEach(section => navObserver.observe(section));

const revealObserver = new IntersectionObserver((entries, observer) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.classList.add("visible");
      observer.unobserve(entry.target);
    }
  });
}, { threshold: 0.12 });

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
}, { threshold: 0.7 });

counters.forEach(counter => counterObserver.observe(counter));

// Si aucune vidéo n'est fournie, le poster du hero reste visible.
const video = document.querySelector(".hero-video");
video?.addEventListener("error", () => {
  video.style.display = "none";
});




        // Récupération des éléments

        const boutonOuvrir = document.getElementById("ouvrir-partenaires");

        const popup = document.getElementById("popup-partenaires");

        const boutonFermer = document.getElementById("fermer-partenaires");


        // OUVRIR LA FENÊTRE

        boutonOuvrir.addEventListener("click", function (event) {

            event.preventDefault();

            popup.classList.add("active");

        });


        // FERMER AVEC LE X

        boutonFermer.addEventListener("click", function () {

            popup.classList.remove("active");

        });


        // FERMER EN CLIQUANT SUR LE FOND SOMBRE

        popup.addEventListener("click", function (event) {

            if (event.target === popup) {

                popup.classList.remove("active");

            }

        });