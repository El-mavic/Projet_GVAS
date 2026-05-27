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

// /* ================= LIKE ================= */

// let likeBtn = document.getElementById("likeBtn");
// let likeCount = document.getElementById("likeCount");

// let liked = false;
// let compteur = 0;

// likeBtn.addEventListener("click", () => {
//   if (!liked) {
//     compteur++;
//     liked = true;

//     likeBtn.classList.add("like-active");
//   } else {
//     compteur--;
//     liked = false;

//     likeBtn.classList.remove("like-active");
//   }

//   likeCount.textContent = compteur;

//   /* Effet animation à chaque clic */

//   //   likeBtn.style.transform = "scale(1.25)";
//   likeBtn.style.boxShadow = "0 0 25px #ff004c";

//   setTimeout(() => {
//     if (liked) {
//       //   likeBtn.style.transform = "scale(1.15)";
//       likeBtn.style.boxShadow = "0 0 20px #ff004c";
//     } else {
//       //   likeBtn.style.transform = "scale(1)";
//       likeBtn.style.boxShadow = "none";
//     }
//   }, 200);
// });

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

/* Validation */

valider.addEventListener("click", () => {
  let email = document.getElementById("email").value;

  if (email !== "") {
    alert("Merci pour ce geste !!");

    popup.style.display = "none";

    /* Changement du texte */

    subscribeBtn.innerHTML = "Vous êtes abonné";

    /* Animation lumineuse */

    subscribeBtn.style.background = "#00cc66";

    // subscribeBtn.style.transform = "scale(1.15)";

    subscribeBtn.style.boxShadow = "0 0 25px #00ff88";

    /* Effet retour */

    setTimeout(() => {
      //   subscribeBtn.style.transform = "scale(1)";
      subscribeBtn.style.boxShadow = "0 0 15px #00ff88";
    }, 250);
  } else {
    alert("Veuillez entrer une adresse mail.");
  }
});

/* Animation à chaque clic du bouton abonnement */

subscribeBtn.addEventListener("click", () => {
  //   subscribeBtn.style.transform = "scale(1.12)";
  subscribeBtn.style.boxShadow = "0 0 20px #0066ff";

  setTimeout(() => {
    // subscribeBtn.style.transform = "scale(1)";
    subscribeBtn.style.boxShadow = "none";
  }, 200);
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

let popu = document.getElementById("pap");

window.addEventListener("click", (event)=>{

    if(event.target != popu){

        popup.style.display = "none";

    }

});



// 
// 
// menuBurger
let burger = document.getElementById("burger");

let menu = document.getElementById("menu");

burger.addEventListener("click", () => {

  menu.classList.toggle("active");

  burger.classList.toggle("active");

});

