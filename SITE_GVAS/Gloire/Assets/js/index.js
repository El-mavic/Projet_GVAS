// blocs

function ouvrir() {
  document.getElementById("fenetre").style.display = "block";
}
function fermer() {
  document.getElementById("fenetre").style.display = "none";
}
// Quand tu clique à coté le fenetre doit se fermé
window.onclick = function (event) {
  const modal = document.getElementById("fenetre");

  if (event.target === modal) {
    modal.style.display = "none";
  }
};

/* ================= ABONNEMENT ================= */

let subscribeBtn = document.getElementById("subscribeBtn");
let popup = document.getElementById("popup");
let closePopup = document.getElementById("closePopup");
let valider = document.getElementById("valider");

subscribeBtn.addEventListener("click", () => {
  popup.style.display = "flex";
});

/* Fermer avec X */

closePopup.addEventListener("click", () => {
  popup.style.display = "none";
});




/* ================= PARTAGE ================= */

let shareBtn = document.getElementById("shareBtn");

shareBtn.addEventListener("click", async () => {
  /* Animation */

  //   shareBtn.style.transform = "scale(1.15)";
  shareBtn.style.boxShadow = "0 0 20px #00ff99";

  setTimeout(() => {
    // shareBtn.style.transform = "scale(1)";
    shareBtn.style.boxShadow = "none";
  }, 200);

  if (navigator.share) {
    await navigator.share({
      title: document.title,
      text: "Découvrez cette page !",
      url: window.location.href,
    });
  } else {
    alert("Le partage n'est pas supporté sur ce navigateur.");
  }
});


// closing
// let popu = document.getElementById("pap");

// window.addEventListener("click", (event)=>{

//     if(event.target != popu){

//         popup.style.display = "none";

//     }

// });

// menuBurger
let burger = document.getElementById("burger");

let menu = document.getElementById("menu");

burger.addEventListener("click", () => {

  menu.classList.toggle("active");

  burger.classList.toggle("active");

});

