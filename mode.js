
const bouton = document.createElement("button");
bouton.textContent = "🌙 Dark";
bouton.id = "mode-toggle-btn";
document.body.appendChild(bouton);


bouton.style.cssText = `
  position: fixed;
  bottom: 28px;
  right: 28px;
  z-index: 9999;
  padding: 10px 20px;
  border-radius: 50px;
  border: 2px solid #3b5d50;
  background: white;
  color: #3b5d50;
  font-family: 'DM Sans', sans-serif;
  font-size: 14px;
  font-weight: 700;
  cursor: pointer;
  box-shadow: 0 4px 15px rgba(0,0,0,0.2);
`;


const stylesDark = `
  body, .content          { background-color: #0f1a16 !important; }
  .sidebar                { background-color: #0d1f18 !important; }
  .page-header            { background-color: #0d1f18 !important; }
  .room-card              { background-color: #1a2b24 !important; }
  .stat-card              { background-color: #162620 !important; }
  .search-bar             { background-color: #162620 !important; color: #e8f5ef !important; border-color: #2a4a38 !important; }
  .room-content h3        { color: #e8f5ef !important; }
  .room-author            { color: #7a9e8e !important; }
  .progress-text          { color: #7a9e8e !important; }
  .host-name              { color: #e8f5ef !important; }
  .host-role              { background: #1e3a2c !important; color: #6db891 !important; }
  .tag                    { background: #1e3029 !important; border-color: #2a4a38 !important; color: #6db891 !important; }
  .stat-title             { color: #7a9e8e !important; }
  .progress-bar-bg        { background: #1e3029 !important; }
  hr.separator            { border-top-color: #1e3029 !important; }
`;


const baliseStyle = document.createElement("style");
baliseStyle.id = "dark-mode-style";
document.head.appendChild(baliseStyle);


let modeEstSombre = false;


bouton.addEventListener("click", function () {

  if (modeEstSombre) {
   
    baliseStyle.textContent = "";       
    bouton.textContent = "🌙 Dark";      
    modeEstSombre = false;

  } else {
    
    baliseStyle.textContent = stylesDark; 
    bouton.textContent = "☀️ Light";      
    modeEstSombre = true;
  }

});