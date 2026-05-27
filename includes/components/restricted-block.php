<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="../../assets/css/restricted-block.css">
<style>
    <?php include __DIR__ . '/../../assets/css/restricted-block.css'; ?>
</style>

<div class="access-denied">

  <div class="ad-icon-container">
    <span class="material-icons">lock</span>
  </div>

  <div class="ad-badge">
    Accès restreint
  </div>

  <h2 class="ad-title">
    Espace réservé
  </h2>

  <div class="ad-divider"></div>

  <p class="ad-text">
    Désolé, cette fonctionnalité est réservée aux membres de la communauté 
    <strong>KITABI</strong>. 
    Rejoignez-nous dès maintenant pour participer et accéder à tous nos espaces.
  </p>

  <div class="ad-btn-container">
    <a href="../../includes/controllers/index.php?page=login" class="ad-btn-login">
      <span class="material-icons">login</span> Se connecter
    </a>
    
    <a href="../../includes/controllers/index.php?page=register" class="ad-btn-register">
      <span class="material-icons">person_add</span> Créer un compte
    </a>
  </div>

</div>