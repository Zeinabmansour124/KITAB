<link rel="stylesheet" href="/projet_web/KITAB/assets/css/register.css">

<div class="auth">

    <!-- LEFT: FORM -->
    <section class="auth__left">

        <div class="auth__card">

            <header class="auth__header">
                <h1>Créer un compte 📚</h1>
                <p class="auth__subtitle">Rejoins la communauté des lecteurs</p>
            </header>

            <form class="auth__form"
                  action="/projet_web/KITAB/includes/controllers/index.php?page=register"
                  method="POST"
                  enctype="multipart/form-data">

                <div class="auth__row">
                    <input type="text" name="nom" placeholder="Nom" required>
                    <input type="text" name="prenom" placeholder="Prénom" required>
                </div>

                <div class="auth__group">
                    <input type="email" name="email" placeholder="Email" required>
                </div>

                <div class="auth__group">
                    <input type="password" name="password" placeholder="Mot de passe" required>
                </div>

                <div class="auth__group">
                    <textarea name="bio" placeholder="Parle de toi..." rows="3"></textarea>
                </div>

                <div class="auth__upload">

                    <label for="avatar">Photo de profil</label>

                    <div class="auth__uploadBox">
                        <input type="file" name="avatar" id="avatar" accept="image/*">

                        <div class="auth__preview">
                            <img id="previewImg" src="https://via.placeholder.com/120" alt="preview">
                        </div>
                    </div>

                </div>

                <button type="submit" class="auth__btn">
                    S'inscrire 🚀
                </button>

            </form>

            <footer class="auth__footer">
                <p>
                    Déjà un compte ?
                    <a href="/projet_web/KITAB/views/auth/login.php">Se connecter</a>
                </p>
            </footer>

        </div>
    </section>

    <!-- RIGHT: VISUAL / CAROUSEL -->
    <aside class="auth__right">

        <div class="auth__slide is-active">
            <img src="/projet_web/KITAB/photos/citation2.webp" alt="">
            <p>“A reader lives a thousand lives.”</p>
        </div>

        <div class="auth__slide">
            <img src="/projet_web/KITAB/photos/citation3.jpg" alt="">
            <p>“Books are magic portals.”</p>
        </div>

        <div class="auth__slide">
            <img src="/projet_web/KITAB/photos/citation1.jpg" alt="">
            <p>“Read. Learn. Transform.”</p>
        </div>

    </aside>

</div>

<script src="/projet_web/KITAB/assets/js/auth.js"></script>