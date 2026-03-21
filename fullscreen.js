document.addEventListener("DOMContentLoaded", function () {
 
  
  const bouton = document.createElement("button");
  bouton.id = "fullscreen-btn";
  bouton.innerHTML = `⛶ Plein Écran`;
  document.body.appendChild(bouton);
 
 
  
  const style = document.createElement("style");
  style.textContent = `
    #fullscreen-btn {
      position: fixed;
      bottom: 28px;
      left: 320px;
      z-index: 9999;
      padding: 10px 20px;
      border-radius: 50px;
      border: 2px solid #3b5d50;
      background: white;
      color: #3b5d50;
      font-family: 'DM Sans', sans-serif;
      font-size: 14px;
      font-weight: 600;
      cursor: pointer;
      box-shadow: 0 4px 12px rgba(59,93,80,0.2);
      transition: all 0.3s ease;
    }
 
    #fullscreen-btn:hover {
      background: #3b5d50;
      color: white;
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(59,93,80,0.35);
    }
 
    /* Cacher la sidebar en plein écran */
    body.fullscreen .sidebar {
      display: none;
    }
 
    /* Le contenu prend toute la largeur */
    body.fullscreen .content {
      margin-left: 0 !important;
      width: 100% !important;
    }
 
    /* Bouton se déplace à gauche quand sidebar cachée */
    body.fullscreen #fullscreen-btn {
      left: 20px;
    }
  `;
  document.head.appendChild(style);
 
 
  
  let estPleinEcran = false;
 
  bouton.addEventListener("click", function () {
 
    if (estPleinEcran) {
 
     
      if (document.exitFullscreen) {
        document.exitFullscreen();
      }
      document.body.classList.remove("fullscreen");
      bouton.innerHTML = `⛶ Plein Écran`;
      estPleinEcran = false;
 
    } else {
 
     
      if (document.documentElement.requestFullscreen) {
        document.documentElement.requestFullscreen();
      }
      document.body.classList.add("fullscreen");
      bouton.innerHTML = `✕ Quitter Plein Écran`;
      estPleinEcran = true;
 
    }
 
  });
 
 
  document.addEventListener("fullscreenchange", function () {
    if (!document.fullscreenElement) {
      document.body.classList.remove("fullscreen");
      bouton.innerHTML = `⛶ Plein Écran`;
      estPleinEcran = false;
    }
  });
 
});
 