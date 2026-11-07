<?php if (!isset($pageTitle)) $pageTitle = 'Découvrir les talents'; ?>
<!doctype html>
<html lang="fr">

<head>
    <!-- Encodage et affichage responsive -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">

    <!-- Référencement et partage sur les réseaux sociaux -->
    <meta name="description" content="Recherchez des professionnels et découvrez leurs portfolios sur Profolio.">
    <meta name="keywords" content="Profolio, portfolio professionnel, talents, CV, professionnels, projets">
    <meta name="author" content="Équipe BHS">
    <meta name="robots" content="index, follow">

    <!-- Apparence et couleur de l'application mobile -->
    <meta name="theme-color" content="#061a3d">
    <meta name="color-scheme" content="light">
    <meta name="format-detection" content="telephone=no">

    

    <title><?= e($pageTitle) ?> — Mon Portfolio</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Manrope:wght@500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/test.css">
    <link rel="icon" type="image/png" href="../Mes_images/logo1.png">



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
                <?php $currentPage = basename($_SERVER['PHP_SELF']); ?>
                <?php if ($currentPage === 'apropos.php'): ?>
                    <li class="mobile-menu-home">
                        <a href="index.php"><i class="fa-solid fa-house"></i> Accueil</a>
                    </li>
                <?php elseif ($currentPage === 'index.php'): ?>
                    <li class="mobile-menu-about">
                        <a href="apropos.php"><i class="fa-solid fa-circle-info"></i> À propos</a>
                    </li>
                <?php elseif ($currentPage === 'dashboard.php'): ?>
                    <li class="mobile-menu-home">
                        <a href="index.php"><i class="fa-solid fa-house"></i> Accueil</a>
                    </li>
                <?php else: ?>
                    <li class="mobile-menu-home">
                        <a href="index.php"><i class="fa-solid fa-house"></i> Accueil</a>
                    </li>
                    <li class="mobile-menu-about">
                        <a href="apropos.php"><i class="fa-solid fa-circle-info"></i> À propos</a>
                    </li>
                <?php endif; ?>
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

            <?php $currentHeaderPage = basename($_SERVER['PHP_SELF']); ?>
            <?php if ($currentHeaderPage === 'apropos.php' || $currentHeaderPage === 'dashboard.php'): ?>
                <a href="index.php"> Accueil</a>
            <?php else: ?>
                <a href="apropos.php" class="about"> À propos</a>
            <?php endif; ?>

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