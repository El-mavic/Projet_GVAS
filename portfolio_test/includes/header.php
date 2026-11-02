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
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body>

    <header class="topbar">



        <a href="index.php" class="logo">
            <img src="../Mes_images/logo.png" alt="Logo Portfolio">
        </a>
        <div class="header-message">
            <div class="message-track">
                <span>Révèle ton talent, valorise tes projets et ouvre les portes de nouvelles opportunités professionnelles</span>

            </div>
        </div>
        <nav class="nav">


            <?php if (basename($_SERVER['PHP_SELF']) === 'index.php'): ?>
                <a href="admin_login.php" class="nav-cta">
                    <i class="fas fa-user-shield"> </i>

                </a>
            <?php endif; ?>


            <?php if (!empty($_SESSION['user_id'])): ?>

                <a href="dashboard.php">
                    Mon espace
                </a>

                <a href="logout.php" class="nav-cta">
                    Déconnexion
                </a>

            <?php else: ?>

                <a href="login.php">
                    Connexion
                </a>

                <a class="nav-cta" href="register.php">
                    Créer
                </a>

            <?php endif; ?>

        </nav>

    </header>

    <main class="page">
        <script src="assets/js/script.js"></script>