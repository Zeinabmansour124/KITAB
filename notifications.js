
document.addEventListener("DOMContentLoaded", function () {

  
  const bouton = document.createElement("button");
  bouton.id = "notif-btn";
  bouton.innerHTML = ` Sera Notifié`;

 
  const wrapper = document.createElement("div");
  wrapper.id = "header-btns";


  const createRoom = document.querySelector(".create-room-btn");
  createRoom.parentNode.insertBefore(wrapper, createRoom);
  wrapper.appendChild(bouton);
  wrapper.appendChild(createRoom);


 
  const style = document.createElement("style");
  style.textContent = `
    
    #header-btns {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    #notif-btn {
      padding: 12px 24px;
      border-radius: 15px;
      border: 2px solid white;
      background: transparent;
      color: white;
      font-family: 'DM Sans', sans-serif;
      font-size: 15px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    #notif-btn:hover {
      background: white;
      color: #3b5d50;
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(255,255,255,0.3);
    }

    #notif-btn.actif {
      background: white;
      color: #3b5d50;
    }
  `;
  document.head.appendChild(style);

  
  let actif = false;

  bouton.addEventListener("click", function () {
    if (actif) {
      bouton.innerHTML = ` Sera Notifié`;
      bouton.classList.remove("actif");
      actif = false;
    } else {
      bouton.innerHTML = ` Notifié !`;
      bouton.classList.add("actif");
      actif = true;
    }
  });

});