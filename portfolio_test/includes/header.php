<?php if (!isset($pageTitle)) $pageTitle = 'Découvrir les talents'; ?>
<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Recherchez des professionnels et découvrez leurs portfolios.">
    <title><?= e($pageTitle) ?> — Mon Portfolio</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Manrope:wght@500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/test.css">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body>


    <!-- menu burger -->


    <nav class="navbar">
        
        <div class="navbar-logo">
            <a href="index.php" class="pic"><img src="../Mes_images/logo1.png" alt="Profolio"></a>
            <span class="name">Profolio</span>
        </div>

        <div class="navlinks" id="navlinks-menu">
            <span class="mobile-menu-title">Navigation</span>
            <ul>
                <li class="mobile-menu-home<?= basename($_SERVER['PHP_SELF']) === 'index.php' ? ' is-active' : '' ?>">
                    <a href="index.php"><i class="fa-solid fa-house"></i> Accueil</a>
                </li>
                <li class="mobile-menu-about<?= basename($_SERVER['PHP_SELF']) === 'apropos.php' ? ' is-active' : '' ?>">
                    <a href="apropos.php"><i class="fa-solid fa-circle-info"></i> À propos</a>
                </li>
                <?php if (!empty($_SESSION['user_id'])): ?>
                    <?php if (basename($_SERVER['PHP_SELF']) === 'dashboard.php'): ?>
                        <li class="mobile-menu-payment">
                            <a href="dashboard.php#paiement" data-dashboard-panel="payment"><i class="fa-solid fa-credit-card"></i> Paiement</a>
                        </li>
                    <?php endif; ?>
                    <li class="mobile-menu-space<?= basename($_SERVER['PHP_SELF']) === 'dashboard.php' ? ' is-active' : '' ?>">
                        <a href="dashboard.php"><i class="fa-solid fa-user"></i> Mon tableau de bord</a>
                    </li>
                    <?php if (basename($_SERVER['PHP_SELF']) === 'dashboard.php'): ?>
                        <li class="mobile-menu-danger">
                            <a href="dashboard.php#supprimer-compte" data-dashboard-panel="danger"><i class="fa-solid fa-shield-halved"></i> Zone sensible</a>
                        </li>
                    <?php endif; ?>
                    <li class="mobile-menu-session">
                        <a href="logout.php" class="nav-cta"><i class="fa-solid fa-right-from-bracket"></i> Déconnexion</a>
                    </li>
                <?php else: ?>
                    <li class="mobile-menu-session">
                        <a href="login.php"><i class="fa-solid fa-right-to-bracket"></i> Connexion</a>
                    </li>
                    <li class="mobile-menu-register">
                        <a href="register.php" class="nav-cta"><i class="fa-solid fa-user-plus"></i> Créer un compte</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
        <button class="menu-burger" type="button" aria-label="Ouvrir le menu" aria-expanded="false" aria-controls="navlinks-menu">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </nav>
    <button class="mobile-menu-overlay" type="button" aria-label="Fermer le menu"></button>



    <header class="topbar">



        <a href="index.php" class="logo">
            <img src="../Mes_images/logo1.png" alt="Logo Portfolio" class="pic">
        </a>
        <div class="header-message">
            <div class="message-track">
                <span>Révèle ton talent, valorise tes projets et ouvre les portes de nouvelles opportunités professionnelles</span>

            </div>
        </div>
        <nav class="nav">

            <a href="apropos.php"> À propos</a>

            <?php if (!empty($_SESSION['user_id'])): ?>

                <?php if (basename($_SERVER['PHP_SELF']) === 'dashboard.php'): ?>
                    <a href="dashboard.php#paiement" class="header-payment-button" data-dashboard-panel="payment">
                        <i class="fa-solid fa-credit-card"></i>
                        Paiement
                    </a>
                <?php endif; ?>

                <div class="space-menu">
                    <button class="space-menu-toggle" type="button" aria-expanded="false" aria-controls="space-menu-dropdown">
                        Mon espace <i class="fa-solid fa-chevron-down"></i>
                    </button>
                    <div class="space-menu-dropdown" id="space-menu-dropdown" hidden>
                        <a href="dashboard.php">
                            <i class="fa-solid fa-user"></i>
                            <span>Mon tableau de bord</span>
                        </a>
                        <a href="dashboard.php#supprimer-compte" data-dashboard-panel="danger">
                            <i class="fa-solid fa-shield-halved"></i>
                            <span>Zone sensible</span>
                        </a>
                    </div>
                </div>

                <a href="logout.php" class="nav-cta">
                    Déconnexion
                </a>

            <?php else: ?>

                <a href="login.php">
                    Connexion
                </a>

                <a class="nav-cta" href="register.php">
                    Créer un compte
                </a>

            <?php endif; ?>

        </nav>

    </header>

    <main class="page">
        <script src="assets/js/script.js"></script>