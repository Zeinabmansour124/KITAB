<link rel="stylesheet" href="/projet_web/KITAB/assets/css/register.css">

<div class="auth-wrapper">

    <!-- LEFT: FORM -->
    <div class="auth-left">

        <div class="auth-card">

            <h2>Créer un compte 📚</h2>
            <p class="subtitle">Rejoins la communauté des lecteurs</p>

            <form action="/projet_web/KITAB/includes/controllers/index.php?page=register"
                  method="POST"
                  enctype="multipart/form-data">

                <div class="row">
                    <input type="text" name="name" placeholder="Nom" required>
                    <input type="text" name="lastname" placeholder="Prénom" required>
                </div>

                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Mot de passe" required>
                <input type="text" name="location" placeholder="Localisation" required>

                <textarea name="bio" placeholder="Parle de toi..." rows="3"></textarea>

                <div class="image-upload">
                    <label>Photo de profil</label>

                    <input type="file" name="profile_image" id="profile_image" accept="image/*">

                    <div class="preview">
                        <img id="previewImg" src="https://via.placeholder.com/120">
                    </div>
                </div>

                <button type="submit" class="btn-primary">
                    S'inscrire 🚀
                </button>

            </form>

            <p class="switch-link">
                Déjà un compte ?
                <a href="/projet_web/KITAB/views/auth/login.php">Se connecter</a>
            </p>

        </div>
    </div>

    <!-- RIGHT: CAROUSEL -->
    <div class="auth-right">

        <div class="slide active">
            <img src="/projet_web/KITAB/photos/citation2.webp">
            <p>“A reader lives a thousand lives.”</p>
        </div>

        <div class="slide">
            <img src="/projet_web/KITAB/photos/citation3.jpg">
            <p>“Books are magic portals.”</p>
        </div>

        <div class="slide">
            <img src="/projet_web/KITAB/photos/citation1.jpg">
            <p>“Read. Learn. Transform.”</p>
        </div>

    </div>

</div>

<script src="/projet_web/KITAB/assets/js/auth.js"></script>