<?php
require __DIR__ . '/config.php';
if (empty($_SESSION['admin_id'])) {
    header('Location: admin_login.php');
    exit;
}
if (empty($_SESSION['admin_csrf'])) $_SESSION['admin_csrf'] = bin2hex(random_bytes(32));
$csrf = $_SESSION['admin_csrf'];
$erreur = '';
$ok = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!hash_equals($csrf, (string)($_POST['csrf'] ?? ''))) {
        $erreur = 'Session expirée. Rechargez la page et réessayez.';
    } else {
        $action = (string)($_POST['action'] ?? '');
        try {
            if ($action === 'publish' || $action === 'unpublish') {
                $userId = filter_var($_POST['user_id'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
                if (!$userId) throw new RuntimeException('Profil invalide.');
                if ($action === 'publish') {
                    $stmt = $pdo->prepare("UPDATE users SET public = 1 WHERE id = ? AND payment_status = 'paid'");
                    $stmt->execute([$userId]);
                    if ($stmt->rowCount() === 0) {
                        $check = $pdo->prepare('SELECT payment_status FROM users WHERE id=?');
                        $check->execute([$userId]);
                        $status = $check->fetchColumn();
                        if ($status === false) throw new RuntimeException('Utilisateur introuvable.');
                        if ($status !== 'paid') throw new RuntimeException('Publication refusée : le paiement n’est pas confirmé.');
                    }
                    $ok = 'Portfolio publié.';
                } else {
                    $stmt = $pdo->prepare('UPDATE users SET public = 0 WHERE id = ?');
                    $stmt->execute([$userId]);
                    $ok = 'Portfolio retiré de la page publique.';
                }
            } elseif ($action === 'change_password') {
                $current = (string)($_POST['current_password'] ?? '');
                $new = (string)($_POST['new_password'] ?? '');
                $confirm = (string)($_POST['confirm_password'] ?? '');
                $stmt = $pdo->prepare('SELECT password_hash FROM admin_accounts WHERE id = ?');
                $stmt->execute([(int)$_SESSION['admin_id']]);
                $hash = $stmt->fetchColumn();
                if (!$hash || !password_verify($current, $hash)) throw new RuntimeException('Le mot de passe actuel est incorrect.');
                if (strlen($new) < 12) throw new RuntimeException('Le nouveau mot de passe doit contenir au moins 12 caractères.');
                if ($new !== $confirm) throw new RuntimeException('Les deux nouveaux mots de passe ne correspondent pas.');
                $stmt = $pdo->prepare('UPDATE admin_accounts SET password_hash = ? WHERE id = ?');
                $stmt->execute([password_hash($new, PASSWORD_DEFAULT), (int)$_SESSION['admin_id']]);
                $ok = 'Mot de passe administrateur modifié.';
            }
        } catch (RuntimeException $ex) {
            $erreur = $ex->getMessage();
        } catch (PDOException $ex) {
            $erreur = 'Action impossible. Vérifiez que les migrations SQL sont bien installées.';
        }
    }
}
$search = trim((string)($_GET['q'] ?? ''));
$filter = (string)($_GET['status'] ?? 'all');
$allowed = ['all', 'published', 'unpublished', 'paid', 'unpaid', 'pending', 'failed'];
if (!in_array($filter, $allowed, true)) $filter = 'all';
$stats = ['users' => 0, 'published' => 0, 'unpublished' => 0, 'paid' => 0, 'unpaid' => 0, 'pending' => 0, 'failed' => 0, 'projects' => 0];
try {
    $stats['users'] = (int)$pdo->query('SELECT COUNT(*) FROM users')->fetchColumn();
    $stats['published'] = (int)$pdo->query("SELECT COUNT(*) FROM users WHERE public=1 AND payment_status='paid'")->fetchColumn();
    $stats['unpublished'] = (int)$pdo->query('SELECT COUNT(*) FROM users WHERE public=0')->fetchColumn();
    foreach (['paid', 'unpaid', 'pending', 'failed'] as $s) {
        $st = $pdo->prepare('SELECT COUNT(*) FROM users WHERE payment_status=?');
        $st->execute([$s]);
        $stats[$s] = (int)$st->fetchColumn();
    }
    try {
        $stats['projects'] = (int)$pdo->query('SELECT COUNT(*) FROM projets')->fetchColumn();
    } catch (PDOException $ignored) {
    }
} catch (PDOException $ex) {
    $erreur = 'Impossible de lire les statistiques. Vérifiez la structure de la base.';
}
$where = [];
$params = [];
if ($search !== '') {
    $where[] = '(u.nom LIKE ? OR u.email LIKE ? OR u.metier LIKE ?)';
    $like = '%' . $search . '%';
    array_push($params, $like, $like, $like);
}
if ($filter === 'published') $where[] = "u.public=1 AND u.payment_status='paid'";
elseif ($filter === 'unpublished') $where[] = 'u.public=0';
elseif (in_array($filter, ['paid', 'unpaid', 'pending', 'failed'], true)) {
    $where[] = 'u.payment_status=?';
    $params[] = $filter;
}
$sql = 'SELECT u.id,u.nom,u.email,u.metier,u.public,u.payment_status,u.payment_reference,u.paid_at,u.created_at FROM users u';
if ($where) $sql .= ' WHERE ' . implode(' AND ', $where);
$sql .= ' ORDER BY u.created_at DESC LIMIT 200';
try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $users = $stmt->fetchAll();
} catch (PDOException $ex) {
    $users = [];
    $erreur = 'Impossible de charger les utilisateurs.';
}
try {
    $payments = $pdo->query('SELECT p.id,p.user_id,p.reference,p.provider,p.amount,p.currency,p.status,p.provider_transaction_id,p.created_at,p.paid_at,u.nom,u.email FROM publication_payments p LEFT JOIN users u ON u.id=p.user_id ORDER BY p.created_at DESC LIMIT 100')->fetchAll();
} catch (PDOException $ex) {
    $payments = [];
}
$pageTitle = 'Dashboard administrateur';
?>

<!doctype html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= e($pageTitle) ?> — Mon Portfolio</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Manrope:wght@500;600;700;800&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <!-- En-tête -->
    <header class="topbar admin-topbar">

        <a href="index.php" class="logo">
            <img src="../Mes_images/logo.png" alt="Logo Portfolio">
        </a>
        <div class="header-message">
            <div class="message-track">
                <span>Révèle ton talent, valorise tes projets et ouvre les portes de nouvelles opportunités professionnelles</span>

            </div>
        </div>

        <nav class="nav">
            <a href="index.php">Voir le site </a>
            <a href="#utilisateurs">Utilisateurs</a>
            <a href="#paiements">Paiements</a>

            <a class="nav-cta" href="admin_logout.php">Déconnexion</a>
        </nav>

    </header>


    <main class="page admin-page">

        <!-- Présentation -->
        <section class="dashboard-intro">
            <span class="section-kicker">CENTRE DE CONTRÔLE</span>

            <h1>
                Bonjour, <?= e($_SESSION['admin_username'] ?? 'Admin') ?>
            </h1>

        </section>


        <!-- Messages -->
        <?php if ($erreur): ?>
            <div class="alert"><?= e($erreur) ?></div>
        <?php endif; ?>

        <?php if ($ok): ?>
            <div class="success"><?= e($ok) ?></div>
        <?php endif; ?>


        <!-- Statistiques -->
        <section class="admin-stats">

            <article>
                <span>Comptes créés</span>
                <strong><?= $stats['users'] ?></strong>
                <small>Tous les utilisateurs</small>
            </article>

            <article>
                <span>Portfolios publiés</span>
                <strong><?= $stats['published'] ?></strong>
                <small>Payés et visibles</small>
            </article>

            <article>
                <span>Paiements confirmés</span>
                <strong><?= $stats['paid'] ?></strong>
                <small>Comptes marqués payés</small>
            </article>

            <article>
                <span>En attente</span>
                <strong><?= $stats['pending'] ?></strong>
                <small>À surveiller</small>
            </article>

            <article>
                <span>Non payés</span>
                <strong><?= $stats['unpaid'] ?></strong>
                <small>Pas encore confirmés</small>
            </article>

            <article>
                <span>Projets ajoutés</span>
                <strong><?= $stats['projects'] ?></strong>
                <small>Réalisations des membres</small>
            </article>

        </section>


        <!-- Utilisateurs -->
        <section class="admin-panel" id="utilisateurs">

            <div class="admin-panel-heading">
                <div>
                    <span class="section-kicker">GESTION DES COMPTES</span>
                    <h2>Utilisateurs et portfolios</h2>
                    <p>La publication nécessite un paiement confirmé.</p>
                </div>

                <span class="admin-count">
                    <?= count($users) ?> résultat(s)
                </span>
            </div>


            <!-- Recherche et filtres -->
            <form class="admin-filters" method="get">

                <input
                    type="search"
                    name="q"
                    value="<?= e($search) ?>"
                    placeholder="Rechercher nom, e-mail, métier...">

                <select name="status">
                    <option value="all" <?= $filter === 'all' ? 'selected' : '' ?>>
                        Tous les statuts
                    </option>

                    <option value="published" <?= $filter === 'published' ? 'selected' : '' ?>>
                        Publiés
                    </option>

                    <option value="unpublished" <?= $filter === 'unpublished' ? 'selected' : '' ?>>
                        Non publiés
                    </option>

                    <option value="paid" <?= $filter === 'paid' ? 'selected' : '' ?>>
                        Payés
                    </option>

                    <option value="pending" <?= $filter === 'pending' ? 'selected' : '' ?>>
                        Paiement en attente
                    </option>

                    <option value="unpaid" <?= $filter === 'unpaid' ? 'selected' : '' ?>>
                        Non payés
                    </option>

                    <option value="failed" <?= $filter === 'failed' ? 'selected' : '' ?>>
                        Paiement échoué
                    </option>
                </select>

                <button class="button-primary" type="submit">
                    Filtrer
                </button>

            </form>


            <!-- Tableau des utilisateurs -->
            <div class="admin-table-wrap">

                <table class="admin-table">

                    <thead>
                        <tr>
                            <th>Utilisateur</th>
                            <th>Métier</th>
                            <th>Inscription</th>
                            <th>Paiement</th>
                            <th>Visibilité</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php foreach ($users as $u): ?>

                            <tr>

                                <td>
                                    <strong><?= e($u['nom']) ?></strong>
                                    <small><?= e($u['email']) ?></small>
                                    <small>ID #<?= (int) $u['id'] ?></small>
                                </td>

                                <td><?= e($u['metier'] ?: '—') ?></td>

                                <td>
                                    <?= e(date('d/m/Y', strtotime($u['created_at']))) ?>
                                </td>

                                <td>
                                    <span class="status-pill status-<?= e($u['payment_status']) ?>">
                                        <?= e([
                                            'paid' => 'Payé',
                                            'unpaid' => 'Non payé',
                                            'pending' => 'En attente',
                                            'failed' => 'Échoué'
                                        ][$u['payment_status']] ?? $u['payment_status']) ?>
                                    </span>

                                    <?php if ($u['payment_reference']): ?>
                                        <small>
                                            Réf. <?= e($u['payment_reference']) ?>
                                        </small>
                                    <?php endif; ?>
                                </td>

                                <td>
                                    <span class="status-pill <?= (
                                                                    (int) $u['public'] === 1 &&
                                                                    $u['payment_status'] === 'paid'
                                                                ) ? 'status-paid' : 'status-unpaid' ?>">
                                        <?= (
                                            (int) $u['public'] === 1 &&
                                            $u['payment_status'] === 'paid'
                                        ) ? 'Public' : 'Privé' ?>
                                    </span>
                                </td>

                                <td class="admin-actions">

                                    <?php if (
                                        $u['payment_status'] === 'paid' &&
                                        (int) $u['public'] !== 1
                                    ): ?>

                                        <form method="post">
                                            <input type="hidden" name="csrf" value="<?= e($csrf) ?>">
                                            <input type="hidden" name="action" value="publish">
                                            <input type="hidden" name="user_id" value="<?= (int) $u['id'] ?>">

                                            <button class="mini-button" type="submit">
                                                Publier
                                            </button>
                                        </form>

                                    <?php elseif ((int) $u['public'] === 1): ?>

                                        <form method="post">
                                            <input type="hidden" name="csrf" value="<?= e($csrf) ?>">
                                            <input type="hidden" name="action" value="unpublish">
                                            <input type="hidden" name="user_id" value="<?= (int) $u['id'] ?>">

                                            <button class="mini-button mini-danger" type="submit">
                                                Retirer
                                            </button>
                                        </form>

                                    <?php else: ?>

                                        <span class="muted">En attente du paiement</span>

                                    <?php endif; ?>

                                    <?php if ($u['payment_status'] === 'paid'): ?>
                                        <a
                                            class="mini-link"
                                            href="profil.php?id=<?= (int) $u['id'] ?>"
                                            target="_blank"
                                            rel="noopener">
                                            Voir ↗
                                        </a>
                                    <?php endif; ?>

                                </td>

                            </tr>

                        <?php endforeach; ?>

                        <?php if (!$users): ?>
                            <tr>
                                <td colspan="6" class="admin-empty">
                                    Aucun utilisateur correspondant.
                                </td>
                            </tr>
                        <?php endif; ?>

                    </tbody>
                </table>

            </div>

            <p class="admin-note">
                Le statut payé doit provenir de la confirmation officielle
                de Yabetoo Pay. Il ne peut pas être modifié manuellement ici.
            </p>

        </section>


        <!-- Paiements -->
        <section class="admin-panel" id="paiements">

            <div class="admin-panel-heading">
                <div>
                    <span class="section-kicker">SUIVI FINANCIER</span>
                    <h2>Dernières transactions</h2>
                    <p>Les 100 transactions les plus récentes.</p>
                </div>
            </div>

            <div class="admin-table-wrap">

                <table class="admin-table">

                    <thead>
                        <tr>
                            <th>Référence</th>
                            <th>Utilisateur</th>
                            <th>Montant</th>
                            <th>Fournisseur</th>
                            <th>Statut</th>
                            <th>Date</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php foreach ($payments as $p): ?>

                            <tr>

                                <td>
                                    <strong><?= e($p['reference']) ?></strong>

                                    <?php if ($p['provider_transaction_id']): ?>
                                        <small>
                                            Transaction :
                                            <?= e($p['provider_transaction_id']) ?>
                                        </small>
                                    <?php endif; ?>
                                </td>

                                <td>
                                    <?= e($p['nom'] ?? 'Compte supprimé') ?>
                                    <small><?= e($p['email'] ?? '') ?></small>
                                </td>

                                <td>
                                    <?= number_format((int) $p['amount'], 0, ',', ' ') ?>
                                    <?= e($p['currency']) ?>
                                </td>

                                <td><?= e($p['provider']) ?></td>

                                <td>
                                    <span class="status-pill status-<?= e($p['status']) ?>">
                                        <?= e([
                                            'paid' => 'Payé',
                                            'pending' => 'En attente',
                                            'failed' => 'Échoué',
                                            'cancelled' => 'Annulé'
                                        ][$p['status']] ?? $p['status']) ?>
                                    </span>
                                </td>

                                <td>
                                    <?= e(date('d/m/Y H:i', strtotime($p['created_at']))) ?>
                                </td>

                            </tr>

                        <?php endforeach; ?>

                        <?php if (!$payments): ?>
                            <tr>
                                <td colspan="6" class="admin-empty">
                                    Aucune transaction enregistrée.
                                </td>
                            </tr>
                        <?php endif; ?>

                    </tbody>
                </table>

            </div>

        </section>


        <!-- Sécurité et mot de passe -->
        <section class="admin-panel admin-security" id="securite">

            <div>
                <span class="section-kicker">SÉCURITÉ DU COMPTE</span>
                <h2>Changer le mot de passe Admin</h2>
                <p>Choisissez un mot de passe unique d’au moins 12 caractères.</p>
            </div>

            <form method="post" class="stack-form admin-password-form">

                <input type="hidden" name="csrf" value="<?= e($csrf) ?>">
                <input type="hidden" name="action" value="change_password">

                <label>
                    Mot de passe actuel
                    <input
                        type="password"
                        name="current_password"
                        required
                        autocomplete="current-password">
                </label>

                <label>
                    Nouveau mot de passe
                    <input
                        type="password"
                        name="new_password"
                        required
                        minlength="12"
                        autocomplete="new-password">
                </label>

                <label>
                    Confirmer le nouveau mot de passe
                    <input
                        type="password"
                        name="confirm_password"
                        required
                        minlength="12"
                        autocomplete="new-password">
                </label>

                <button class="button-primary" type="submit">
                    Mettre à jour le mot de passe
                </button>

            </form>

        </section>

    </main>


    <!-- Pied de page -->

    <footer class="footer">

        <div class="footer-container">

            <div class="footer-column">
                <h3>Liens rapides</h3>

                <a href="index.php">
                    <i class="fa-solid fa-house"></i> Accueil
                </a>

                <a href="login.php">
                    <i class="fa-solid fa-right-to-bracket"></i> Connexion
                </a>
            </div>

            <div class="footer-column">
                <h3>Nous contacter</h3>

                <a href="mailto:elmavicd@gmail.com">
                    <i class="fa-solid fa-envelope"></i> elmavicd@gmail.com
                </a>

                <a href="tel:+242064201415">
                    <i class="fa-solid fa-phone"></i> +242 06 420 14 15
                </a>

                <p>
                    <i class="fa-solid fa-location-dot"></i>
                    Pointe-Noire, République du Congo
                </p>

                <a class="footer-button" href="mailto:elmavicd@gmail.com">
                    Nous contacter
                </a>
            </div>

        </div>

        <div class="footer-bottom">
            © <?= date('Y') ?> Mon Portfolio. Tous droits réservés.
        </div>

    </footer>


</body>

</html>