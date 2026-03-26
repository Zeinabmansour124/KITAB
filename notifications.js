document.addEventListener("DOMContentLoaded", function () {
  // 1. Créer le bouton notification
  const bouton = document.createElement("button");
  bouton.id = "notif-btn";
  bouton.type = "button"; // Force le type bouton
  bouton.textContent = "Sera Notifié";

  // 2. Créer le wrapper
  const wrapper = document.createElement("div");
  wrapper.id = "header-btns";

  // 3. Trouver le bouton Create Room (par son ID pour plus de précision)
  const createRoom = document.getElementById("create_room");

  if (createRoom) {
    // Placer le wrapper avant le bouton Create Room
    createRoom.parentNode.insertBefore(wrapper, createRoom);

    // Ajouter les boutons dans le wrapper
    wrapper.appendChild(bouton);
    wrapper.appendChild(createRoom);
  }

  // 4. Style (Ajout de position relative pour le clic)
  const style = document.createElement("style");
  style.textContent = `
    #header-btns { 
      display: flex; 
      gap: 10px; 
      align-items: center; 
      position: relative; 
      z-index: 999; 
    }
    #notif-btn {
      padding: 10px 20px;
      border-radius: 12px;
      border: 2px solid white;
      background: transparent;
      color: white;
      font-family: 'DM Sans', sans-serif;
      font-weight: 600;
      cursor: pointer;
      transition: 0.3s;
      position: relative;
      z-index: 1000;
    }
    #notif-btn:hover, #notif-btn.actif {
      background: white;
      color: #3b5d50;
    }
  `;
  document.head.appendChild(style);

  // 5. Logique de clic (avec preventDefault pour garantir le fonctionnement)
  let actif = false;
  bouton.addEventListener("click", function (e) {
    e.preventDefault(); // EMPÊCHE LE RECHARGEMENT OU LE CONFLIT
    e.stopPropagation(); // EMPÊCHE LE CLIC DE FILTRER AILLEURS
    
    actif = !actif;
    if (actif) {
      this.textContent = "Notifié !";
      this.classList.add("actif");
    } else {
      this.textContent = "Sera Notifié";
      this.classList.remove("actif");
    }
    console.log("Clic détecté !"); // Vérifie dans ta console F12
  });
});