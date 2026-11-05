<?php
require __DIR__ . '/config.php';

if (empty($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$userId = (int)$_SESSION['user_id'];
$stmt = $pdo->prepare('SELECT id, nom, email, payment_status FROM users WHERE id = ?');
$stmt->execute([$userId]);
$user = $stmt->fetch();
if (!$user) {
    header('Location: logout.php');
    exit;
}

$yabetoo = require __DIR__ . '/config/yabetoo.php';
$amount = max(1, (int)$yabetoo['publication_amount']);
$mode = ($yabetoo['mode'] ?? 'sandbox') === 'production' ? 'production' : 'sandbox';
$apiBase = $mode === 'production'
    ? 'https://pay.api.yabetoopay.com/v1'
    : 'https://pay.sandbox.yabetoopay.com/v1';
$error = '';
$success = '';

if (empty($_SESSION['csrf_payment'])) {
    $_SESSION['csrf_payment'] = bin2hex(random_bytes(32));
}

/** Appelle l'API officielle Yabetoo Pay depuis le serveur uniquement. */
function yabetooRequest(string $url, string $secretKey, array $payload = null): array
{
    if (!function_exists('curl_init')) {
        throw new RuntimeException('L’extension PHP cURL est désactivée. Activez-la dans WampServer puis redémarrez Apache.');
    }
    $ch = curl_init($url);
    $headers = ['Authorization: Bearer ' . $secretKey, 'Accept: application/json'];
    $options = [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CONNECTTIMEOUT => 15,
        CURLOPT_TIMEOUT => 45,
        CURLOPT_HTTPHEADER => $headers,
        CURLOPT_SSL_VERIFYPEER => true,
        CURLOPT_SSL_VERIFYHOST => 2,
    ];
    if ($payload !== null) {
        $options[CURLOPT_POST] = true;
        $options[CURLOPT_HTTPHEADER][] = 'Content-Type: application/json';
        $options[CURLOPT_POSTFIELDS] = json_encode($payload, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
    curl_setopt_array($ch, $options);
    $raw = curl_exec($ch);
    $curlError = curl_error($ch);
    $httpCode = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    if ($raw === false) {
        throw new RuntimeException('Connexion à Yabetoo Pay impossible : ' . $curlError);
    }
    $data = json_decode($raw, true);
    if (!is_array($data)) {
        throw new RuntimeException('Réponse inattendue reçue de Yabetoo Pay (HTTP ' . $httpCode . ').');
    }
    if ($httpCode < 200 || $httpCode >= 300) {
        $message = $data['message'] ?? $data['error']['message'] ?? $data['error'] ?? 'Erreur API non détaillée';
        if (is_array($message)) $message = json_encode($message);
        throw new RuntimeException('Yabetoo Pay a refusé la requête (HTTP ' . $httpCode . ') : ' . (string)$message);
    }
    return $data;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($user['payment_status'] ?? 'unpaid') !== 'paid') {
    if (!hash_equals((string)$_SESSION['csrf_payment'], (string)($_POST['csrf'] ?? ''))) {
        $error = 'Session expirée. Rechargez la page et réessayez.';
    } elseif (empty($yabetoo['secret_key']) || strpos((string)$yabetoo['secret_key'], 'REMPLACER_') === 0) {
        $error = 'Yabetoo Pay n’est pas encore configuré : remplacez REMPLACER_PAR_VOTRE_CLE_SECRETE dans config/yabetoo.php ou définissez YABETOO_SECRET_KEY côté serveur.';
    } else {
        $operator = strtolower(trim((string)($_POST['operator'] ?? '')));
        $phoneInput = trim((string)($_POST['phone'] ?? ''));
        $phone = preg_replace('/[\s().-]+/', '', $phoneInput);
        if (!in_array($operator, ['mtn', 'airtel'], true)) {
            $error = 'Choisissez MTN Mobile Money ou Airtel Money.';
        } elseif (!preg_match('/^\+?242[0-9]{9}$/', $phone)) {
            $error = 'Saisissez un numéro du Congo-Brazzaville au format +242XXXXXXXXX (9 chiffres après 242).';
        } else {
            if (substr($phone, 0, 1) === '+') $phone = substr($phone, 1);
            $reference = 'PORT-' . $userId . '-' . strtoupper(bin2hex(random_bytes(5)));
            $paymentId = null;
            try {
                // Enregistrer d'abord la tentative pour que l'administration puisse la suivre.
                $insert = $pdo->prepare("INSERT INTO publication_payments (user_id, reference, provider, amount, currency, status) VALUES (?, ?, 'Yabetoo Pay', ?, 'XAF', 'pending')");
                $insert->execute([$userId, $reference, $amount]);
                $paymentRowId = (int)$pdo->lastInsertId();
                $pdo->prepare("UPDATE users SET payment_status='pending', payment_reference=? WHERE id=?")->execute([$reference, $userId]);

                // Étape 1 : créer l'intention de paiement côté serveur.
                $intent = yabetooRequest($apiBase . '/payment-intents', $yabetoo['secret_key'], [
                    'amount' => $amount,
                    'currency' => 'xaf',
                    'description' => 'Publication du portfolio #' . $userId,
                    'metadata' => ['user_id' => (string)$userId, 'reference' => $reference],
                ]);
                $paymentId = (string)($intent['id'] ?? '');
                $clientSecret = (string)($intent['clientSecret'] ?? $intent['client_secret'] ?? '');
                if ($paymentId === '' || $clientSecret === '') {
                    throw new RuntimeException('Yabetoo Pay n’a pas renvoyé les identifiants nécessaires pour confirmer le paiement.');
                }
                $pdo->prepare('UPDATE publication_payments SET provider_transaction_id=? WHERE id=?')->execute([$paymentId, $paymentRowId]);

                // Étape 2 : confirmer avec les informations Mobile Money du client.
                $confirmation = yabetooRequest($apiBase . '/payment-intents/' . rawurlencode($paymentId) . '/confirm', $yabetoo['secret_key'], [
                    'client_secret' => $clientSecret,
                    'first_name' => (string)($user['nom'] ?? ''),
                    'receipt_email' => (string)($user['email'] ?? ''),
                    'payment_method_data' => [
                        'type' => 'momo',
                        'momo' => [
                            'country' => 'cg',
                            'msisdn' => $phone,
                            'operator_name' => $operator,
                        ],
                    ],
                ]);

                $providerStatus = strtolower((string)($confirmation['status'] ?? ''));
                $captured = ($confirmation['captured'] ?? false) === true;
                $transactionId = (string)($confirmation['transactionId'] ?? $confirmation['transaction_id'] ?? $confirmation['id'] ?? $paymentId);
                if ($providerStatus === 'succeeded' && $captured) {
                    $pdo->beginTransaction();
                    $pdo->prepare("UPDATE publication_payments SET status='paid', provider_transaction_id=?, paid_at=NOW() WHERE id=?")->execute([$transactionId, $paymentRowId]);
                    // La publication est automatique seulement après la réponse confirmée de l'API officielle.
                    $pdo->prepare("UPDATE users SET payment_status='paid', public=1, payment_reference=?, paid_at=NOW() WHERE id=?")->execute([$reference, $userId]);
                    $pdo->commit();
                    $success = 'Paiement confirmé par Yabetoo Pay. Votre portfolio est maintenant publié sur la page d’accueil.';
                    $stmt = $pdo->prepare('SELECT id, nom, email, payment_status FROM users WHERE id = ?');
                    $stmt->execute([$userId]);
                    $user = $stmt->fetch();
                } else {
                    $failed = in_array($providerStatus, ['failed', 'expired', 'canceled', 'cancelled'], true);
                    $newStatus = $failed ? 'failed' : 'pending';
                    $pdo->prepare('UPDATE publication_payments SET status=?, provider_transaction_id=? WHERE id=?')->execute([$newStatus, $transactionId, $paymentRowId]);
                    $pdo->prepare('UPDATE users SET payment_status=? WHERE id=?')->execute([$newStatus, $userId]);
                    if ($failed) {
                        $error = 'Yabetoo Pay indique que le paiement a échoué ou expiré. Vérifiez votre solde puis réessayez.';
                    } else {
                        $error = 'Le paiement n’est pas encore confirmé. Votre portfolio reste privé. Vérifiez votre téléphone et réessayez si nécessaire.';
                    }
                }
            } catch (Throwable $ex) {
                if ($pdo->inTransaction()) $pdo->rollBack();
                // Ne jamais afficher ni enregistrer la clé secrète ou le client_secret.
                error_log('[Yabetoo Pay] ' . $ex->getMessage());
                $error = 'Le paiement n’a pas pu être finalisé. Vérifiez la configuration Yabetoo Pay et réessayez. Si le problème persiste, consultez le journal PHP.';
                if (isset($paymentRowId)) {
                    try {
                        // Si l'appel de confirmation a expiré, le résultat est indéterminé : garder pending
                        // évite de déclarer un échec alors que le fournisseur pourrait avoir encaissé.
                        $safeStatus = !empty($paymentId) ? 'pending' : 'failed';
                        $pdo->prepare('UPDATE publication_payments SET status=? WHERE id=? AND status=\'pending\'')->execute([$safeStatus, $paymentRowId]);
                        $pdo->prepare('UPDATE users SET payment_status=? WHERE id=? AND payment_status=\'pending\'')->execute([$safeStatus, $userId]);
                    } catch (Throwable $ignored) {
                    }
                }
            }
        }
    }
}

$pageTitle = 'Paiement de publication';
require __DIR__ . '/includes/header.php';
?>
<section class="auth-card auth-wide">
    <span class="section-kicker">PUBLICATION DU PORTFOLIO</span>
    <h1>Publier mon portfolio</h1>
    <?php if ($success): ?>
        <div class="success"><?= e($success) ?></div>
        <a class="button-primary" href="dashboard.php">Retour à mon espace →</a>
        <a class="button-secondary" href="index.php">Voir la page d’accueil →</a>
    <?php elseif (($user['payment_status'] ?? 'unpaid') === 'paid'): ?>
        <div class="success">Votre paiement est déjà confirmé. Votre portfolio est publié.</div>
        <a class="button-primary" href="dashboard.php">Retour à mon espace →</a>
    <?php else: ?>
        <p>Le paiement de publication coûte <strong><?= number_format($amount, 0, ',', ' ') ?> FCFA</strong>. Une fois le paiement confirmé par Yabetoo Pay, votre portfolio sera automatiquement publié sur la page d’accueil.</p>
        <?php if ($error): ?><div class="alert"><?= e($error) ?></div><?php endif; ?>
        <form method="post" class="stack-form">
            <input type="hidden" name="csrf" value="<?= e($_SESSION['csrf_payment']) ?>">
            <label>Opérateur Mobile Money
                <select name="operator" required>
                    <option value="">Choisissez un opérateur</option>
                    <option value="mtn" <?= (($_POST['operator'] ?? '') === 'mtn') ? 'selected' : '' ?>>MTN Mobile Money</option>
                    <option value="airtel" <?= (($_POST['operator'] ?? '') === 'airtel') ? 'selected' : '' ?>>Airtel Money</option>
                </select>
            </label>
            <label>Numéro Mobile Money
                <input type="tel" name="phone" required placeholder="+242 00 000 00 00"
                    value="<?= e($_POST['phone'] ?? '') ?>" autocomplete="tel">
                <small>Utilisez le numéro associé à votre compte Mobile Money, au format +242 00 000 00 00.</small>
            </label>
            <button class="button-primary" type="submit">Payer <?= number_format($amount, 0, ',', ' ') ?>
                FCFA avec Yabetoo Pay </button>
        </form>
        <p class="muted" style="margin-top:1rem">Mode actuel : <?= $mode === 'sandbox' ? 'test (sandbox)' : 'production' ?>
            . Votre profil reste privé tant que l’API Yabetoo Pay n’a pas confirmé le paiement.</p>
        <a class="button-secondary" href="dashboard.php">Retourner compléter mon portfolio</a>
    <?php endif; ?>
</section>
<?php require __DIR__ . '/includes/footer.php'; ?>