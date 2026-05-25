<link rel="stylesheet" href="/projet_web/KITAB/assets/css/login.css">

<div class="register-container">

    <div class="register-card">

        <h2>Se connecter</h2>
        <p class="subtitle">Bon retour parmi les lecteurs 📚</p>

        <form action="/projet_web/KITAB/includes/controllers/index.php?page=login"
              method="POST"
              enctype="multipart/form-data">

            <input type="email" name="email" placeholder="Email" required>

            <input type="password" name="password" placeholder="Mot de passe" required>

            <button type="submit" class="btn-register">
                Connexion
            </button>

        </form>


    </div>


</div>