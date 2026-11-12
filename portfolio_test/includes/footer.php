</main>

<footer class="footer" id="footer">

    <div class="footer-container">

        <div class="footer-column">

            <a href="index.php" class="footer-login-link">
                <i class="fa-solid fa-house"></i> Accueil
            </a>

            <a href="apropos.php" class="footer-login-link">
                <i class="fa-solid fa-circle-info"></i> À propos
            </a>

            <div class="footer-login-menu">
                <a href="login.php" class="footer-login-link">
                    <i class="fa-solid fa-right-to-bracket"></i> Connexion
                </a>
                <a href="admin_login.php" class="footer-admin-link" aria-label="Connexion administrateur">
                    <i class="fas fa-user-shield"></i>
                </a>
            </div>
        </div>

        <div class="footer-column">

            <a href="mailto:elmavicd@gmail.com" class="box1">
                <i class="fa-solid fa-envelope"></i> elmavicd@gmail.com
            </a>

            <a href="tel:+242064201415" class="box2">
                <i class="fa-solid fa-phone"></i> (+242) 06 420 14 15
            </a>

            <a class="box3">
                <i class="fa-solid fa-location-dot"></i>
                Pointe-Noire, République du Congo
            </a>
        </div>

    </div>

    <div class="footer-bottom">
        <div class="footer-bottom-text">
            © <?= date('Y') ?> <strong>Profolio</strong> — Une création de l’équipe BHS.
        </div>
    </div>

</footer>

<?php if (basename($_SERVER['PHP_SELF']) === 'dashboard.php'): ?>
    <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@29.5.0/dist/js/intlTelInput.min.js" defer></script>
<?php endif; ?>
<script src="assets/js/app.js" defer></script>

</body>

</html>