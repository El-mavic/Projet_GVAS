<?php

require_once __DIR__ . '/config.php';

// =====================================================
// 1. VERIFICATION DE LA SESSION UTILISATEUR
// =====================================================

if (empty($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$userId = (int) $_SESSION['user_id'];

$stmt = $pdo->prepare(
    'SELECT id, nom, email, payment_status FROM users WHERE id = ? LIMIT 1'
);
$stmt->execute([$userId]);

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    header('Location: logout.php');
    exit;
}


// =====================================================
// 2. CONFIGURATION YABETOO PAY
// =====================================================

$yabetoo = require __DIR__ . '/config/yabetoo.php';

$secretKey = trim((string)($yabetoo['secret_key'] ?? ''));

$amount = max(1, (int)($yabetoo['publication_amount'] ?? 1000));

$mode = ($yabetoo['mode'] ?? 'sandbox') === 'production'
    ? 'production'
    : 'sandbox';

$apiBase = $mode === 'production'
    ? 'https://pay.api.yabetoopay.com/v1'
    : 'https://pay.sandbox.yabetoopay.com/v1';

$error = '';
$success = '';


// =====================================================
// 3. PROTECTION CSRF
// =====================================================

if (empty($_SESSION['csrf_payment'])) {
    $_SESSION['csrf_payment'] = bin2hex(random_bytes(32));
}


// =====================================================
// 4. FONCTION DE COMMUNICATION AVEC YABETOO PAY
// =====================================================

function yabetooRequest(
    string $url,
    string $secretKey,
    ?array $payload = null
): array {

    if (!function_exists('curl_init')) {
        throw new RuntimeException(
            'L’extension PHP cURL est désactivée. Activez-la dans WampServer.'
        );
    }

    $ch = curl_init($url);

    $headers = [
        'Authorization: Bearer ' . $secretKey,
        'Accept: application/json'
    ];

    $options = [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CONNECTTIMEOUT => 15,
        CURLOPT_TIMEOUT => 45,
        CURLOPT_HTTPHEADER => $headers,
        CURLOPT_SSL_VERIFYPEER => true,
        CURLOPT_SSL_VERIFYHOST => 2
    ];

    if ($payload !== null) {

        $jsonPayload = json_encode(
            $payload,
            JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
        );

        if ($jsonPayload === false) {
            curl_close($ch);
            throw new RuntimeException(
                'Impossible de préparer les données du paiement.'
            );
        }

        $headers[] = 'Content-Type: application/json';

        $options[CURLOPT_POST] = true;
        $options[CURLOPT_HTTPHEADER] = $headers;
        $options[CURLOPT_POSTFIELDS] = $jsonPayload;
    }

    curl_setopt_array($ch, $options);

    $raw = curl_exec($ch);

    $curlError = curl_error($ch);

    $httpCode = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);

    curl_close($ch);

    if ($raw === false) {
        throw new RuntimeException(
            'Connexion à Yabetoo Pay impossible : ' . $curlError
        );
    }

    $data = json_decode($raw, true);

    if (!is_array($data)) {
        throw new RuntimeException(
            'Réponse inattendue de Yabetoo Pay. HTTP : ' . $httpCode
        );
    }

    if ($httpCode < 200 || $httpCode >= 300) {

        $message = $data['message']
            ?? $data['error']['message']
            ?? $data['error']
            ?? 'Erreur API non détaillée';

        if (is_array($message)) {
            $message = json_encode($message);
        }

        throw new RuntimeException(
            'Yabetoo Pay a refusé la requête (HTTP '
                . $httpCode . ') : ' . (string)$message
        );
    }

    return $data;
}


// =====================================================
// 5. TRAITEMENT DU PAIEMENT
// =====================================================

if (
    $_SERVER['REQUEST_METHOD'] === 'POST'
    && ($user['payment_status'] ?? 'unpaid') !== 'paid'
) {

    // Vérification du jeton CSRF
    if (
        !hash_equals(
            (string)$_SESSION['csrf_payment'],
            (string)($_POST['csrf'] ?? '')
        )
    ) {

        $error = 'Session expirée. Rechargez la page et réessayez.';
    }

    // Vérification de la clé secrète
    elseif ($secretKey === '') {

        $error = 'Clé secrète Yabetoo Pay absente. Vérifiez votre fichier .env et config/yabetoo.php.';
    } else {

        $operator = strtolower(
            trim((string)($_POST['operator'] ?? ''))
        );

        $phoneInput = trim(
            (string)($_POST['phone'] ?? '')
        );

        // Nettoyage du numéro
        $phone = preg_replace('/[\s().-]+/', '', $phoneInput);

        // Vérification de l'opérateur
        if (!in_array($operator, ['mtn', 'airtel'], true)) {

            $error = 'Choisissez MTN Mobile Money ou Airtel Money.';
        }

        // Vérification du numéro congolais
        elseif (!preg_match('/^\+?242[0-9]{9}$/', $phone)) {

            $error = 'Saisissez un numéro du Congo-Brazzaville au format +242XXXXXXXXX.';
        } else {

            // Suppression du signe +
            if (substr($phone, 0, 1) === '+') {
                $phone = substr($phone, 1);
            }

            // Référence unique du paiement
            $reference = 'PORT-' . $userId . '-'
                . strtoupper(bin2hex(random_bytes(5)));

            $paymentId = null;
            $paymentRowId = null;

            try {

                // -----------------------------------------
                // ETAPE 1 : ENREGISTREMENT DE LA TENTATIVE
                // -----------------------------------------

                $insert = $pdo->prepare(
                    "INSERT INTO publication_payments
                    (user_id, reference, provider, amount, currency, status)
                    VALUES (?, ?, 'Yabetoo Pay', ?, 'XAF', 'pending')"
                );

                $insert->execute([
                    $userId,
                    $reference,
                    $amount
                ]);

                $paymentRowId = (int)$pdo->lastInsertId();

                $pdo->prepare(
                    "UPDATE users
                     SET payment_status = 'pending',
                         payment_reference = ?
                     WHERE id = ?"
                )->execute([
                    $reference,
                    $userId
                ]);


                // -----------------------------------------
                // ETAPE 2 : CREATION DE L'INTENTION
                // -----------------------------------------

                $intent = yabetooRequest(
                    $apiBase . '/payment-intents',
                    $secretKey,
                    [
                        'amount' => $amount,
                        'currency' => 'xaf',
                        'description' => 'Publication du portfolio #' . $userId,
                        'metadata' => [
                            'user_id' => (string)$userId,
                            'reference' => $reference
                        ]
                    ]
                );

                $paymentId = (string)(
                    $intent['id'] ?? ''
                );

                $clientSecret = (string)(
                    $intent['clientSecret']
                    ?? $intent['client_secret']
                    ?? ''
                );

                if ($paymentId === '' || $clientSecret === '') {

                    throw new RuntimeException(
                        'Yabetoo Pay n’a pas renvoyé les identifiants nécessaires.'
                    );
                }

                // Enregistrement de l'identifiant fournisseur
                $pdo->prepare(
                    'UPDATE publication_payments
                     SET provider_transaction_id = ?
                     WHERE id = ?'
                )->execute([
                    $paymentId,
                    $paymentRowId
                ]);


                // -----------------------------------------
                // ETAPE 3 : CONFIRMATION MOBILE MONEY
                // -----------------------------------------

                $confirmation = yabetooRequest(
                    $apiBase . '/payment-intents/'
                        . rawurlencode($paymentId) . '/confirm',

                    $secretKey,

                    [
                        'client_secret' => $clientSecret,

                        'first_name' => (string)($user['nom'] ?? ''),

                        'receipt_email' => (string)($user['email'] ?? ''),

                        'payment_method_data' => [
                            'type' => 'momo',

                            'momo' => [
                                'country' => 'cg',
                                'msisdn' => $phone,
                                'operator_name' => $operator
                            ]
                        ]
                    ]
                );


                // -----------------------------------------
                // ETAPE 4 : VERIFICATION DU RESULTAT
                // -----------------------------------------

                $providerStatus = strtolower(
                    (string)($confirmation['status'] ?? '')
                );

                $captured = (
                    ($confirmation['captured'] ?? false) === true
                );

                $transactionId = (string)(
                    $confirmation['transactionId']
                    ?? $confirmation['transaction_id']
                    ?? $confirmation['id']
                    ?? $paymentId
                );


                // -----------------------------------------
                // ETAPE 5 : PAIEMENT REELLEMENT CONFIRME
                // -----------------------------------------

                if (
                    $providerStatus === 'succeeded'
                    && $captured === true
                ) {

                    $pdo->beginTransaction();

                    $pdo->prepare(
                        "UPDATE publication_payments
                         SET status = 'paid',
                             provider_transaction_id = ?,
                             paid_at = NOW()
                         WHERE id = ?"
                    )->execute([
                        $transactionId,
                        $paymentRowId
                    ]);

                    // Publication automatique du portfolio
                    $pdo->prepare(
                        "UPDATE users
                         SET payment_status = 'paid',
                             public = 1,
                             payment_reference = ?,
                             paid_at = NOW()
                         WHERE id = ?"
                    )->execute([
                        $reference,
                        $userId
                    ]);

                    $pdo->commit();

                    $success = 'Paiement confirmé par Yabetoo Pay. Votre portfolio est maintenant publié sur la page d’accueil.';

                    // Actualisation des informations utilisateur
                    $stmt = $pdo->prepare(
                        'SELECT id, nom, email, payment_status
                         FROM users WHERE id = ?'
                    );

                    $stmt->execute([$userId]);

                    $user = $stmt->fetch(PDO::FETCH_ASSOC);
                }

                // -----------------------------------------
                // ETAPE 6 : PAIEMENT NON CONFIRME OU REFUSE
                // -----------------------------------------

                else {

                    $failed = in_array(
                        $providerStatus,
                        [
                            'failed',
                            'expired',
                            'canceled',
                            'cancelled'
                        ],
                        true
                    );

                    $newStatus = $failed ? 'failed' : 'pending';

                    $pdo->prepare(
                        'UPDATE publication_payments
                         SET status = ?,
                             provider_transaction_id = ?
                         WHERE id = ?'
                    )->execute([
                        $newStatus,
                        $transactionId,
                        $paymentRowId
                    ]);

                    $pdo->prepare(
                        'UPDATE users
                         SET payment_status = ?
                         WHERE id = ?'
                    )->execute([
                        $newStatus,
                        $userId
                    ]);

                    if ($failed) {

                        $error = 'Yabetoo Pay indique que le paiement a échoué ou expiré. Vérifiez votre solde puis réessayez.';
                    } else {

                        $error = 'Le paiement est en attente de confirmation. Votre portfolio reste privé. Vérifiez votre téléphone.';
                    }
                }
            }

            // ---------------------------------------------
            // GESTION DES ERREURS
            // ---------------------------------------------

            catch (Throwable $ex) {

                if ($pdo->inTransaction()) {
                    $pdo->rollBack();
                }

                // Journalisation côté serveur uniquement
                error_log(
                    '[Yabetoo Pay] ' . $ex->getMessage()
                );

                $error = 'Le paiement n’a pas pu être finalisé. Vérifiez la configuration Yabetoo Pay et réessayez. Si le problème persiste, consultez le journal PHP.';

                if ($paymentRowId !== null) {

                    try {

                        // Si l'intention existe, le résultat peut être incertain.
                        $safeStatus = !empty($paymentId)
                            ? 'pending'
                            : 'failed';

                        $pdo->prepare(
                            "UPDATE publication_payments
                             SET status = ?
                             WHERE id = ? AND status = 'pending'"
                        )->execute([
                            $safeStatus,
                            $paymentRowId
                        ]);

                        $pdo->prepare(
                            "UPDATE users
                             SET payment_status = ?
                             WHERE id = ?
                             AND payment_status = 'pending'"
                        )->execute([
                            $safeStatus,
                            $userId
                        ]);
                    } catch (Throwable $ignored) {
                        // Ne pas interrompre l'affichage de la page.
                    }
                }
            }
        }
    }
}


// =====================================================
// 6. AFFICHAGE DE LA PAGE
// =====================================================

$pageTitle = 'Paiement de publication';

require __DIR__ . '/includes/header.php';

?>

<div class="payment-page">
    <section class="payment-layout">
        <aside class="payment-summary" aria-label="Résumé de la publication">
            <span class="section-kicker">PUBLICATION DU PORTFOLIO</span>
            <div class="payment-summary-icon"><i class="fa-solid fa-cloud-arrow-up"></i></div>
            <h1>Publier mon portfolio</h1>
            <p>Rendez votre profil professionnel visible au public grâce à une publication sécurisée.</p>
            <div class="payment-price">
                <span>Frais de publication</span>
                <strong><?= number_format($amount, 0, ',', ' ') ?> FCFA</strong>
            </div>
            <ul class="payment-benefits">
                <li><i class="fa-solid fa-circle-check"></i> Portfolio visible sur la page d’accueil</li>
                <li><i class="fa-solid fa-circle-check"></i> Paiement sécurisé par Yabetoo Pay</li>
                <li><i class="fa-solid fa-circle-check"></i> Publication activée après confirmation</li>
            </ul>
        </aside>

        <div class="payment-content">
            <?php if ($success): ?>
                <div class="payment-state payment-state-success">
                    <i class="fa-solid fa-circle-check"></i>
                    <h2>Publication confirmée</h2>
                    <div class="success"><?= e($success) ?></div>
                    <div class="payment-actions">
                        <a class="button-primary" href="dashboard.php"><i class="fa-solid fa-table-columns"></i> Retour à mon espace</a>
                        <a class="button-secondary" href="index.php"><i class="fa-solid fa-house"></i> Voir l’accueil</a>
                    </div>
                </div>
            <?php elseif (($user['payment_status'] ?? 'unpaid') === 'paid'): ?>
                <div class="payment-state payment-state-success">
                    <i class="fa-solid fa-circle-check"></i>
                    <h2>Votre portfolio est publié</h2>
                    <div class="success">Votre paiement est confirmé. Votre portfolio est désormais visible.</div>
                    <div class="payment-actions">
                        <a class="button-primary" href="dashboard.php"><i class="fa-solid fa-table-columns"></i> Retour à mon espace</a>
                    </div>
                </div>
            <?php else: ?>
                <div class="payment-form-heading">
                    <span class="section-kicker">FINALISER LE PAIEMENT</span>
                    <h2>Choisissez Mobile Money</h2>
                    <p>Confirmez votre opérateur et le numéro à utiliser pour le paiement.</p>
                </div>

                <?php if ($error): ?>
                    <div class="alert"><?= e($error) ?></div>
                <?php endif; ?>

                <form method="post" class="stack-form payment-form">
                    <input type="hidden" name="csrf" value="<?= e($_SESSION['csrf_payment']) ?>">
                    <label>
                        Opérateur Mobile Money
                        <select name="operator" required>
                            <option value="">Choisissez un opérateur</option>
                            <option value="mtn" <?= (($_POST['operator'] ?? '') === 'mtn') ? 'selected' : '' ?>>MTN Mobile Money</option>
                            <option value="airtel" <?= (($_POST['operator'] ?? '') === 'airtel') ? 'selected' : '' ?>>Airtel Money</option>
                        </select>
                    </label>

                    <label>
                        Numéro Mobile Money
                        <div class="payment-phone-input">
                            <i class="fa-solid fa-mobile-screen-button"></i>
                            <input type="tel" name="phone" required placeholder="+242 00 000 00 00" value="<?= e($_POST['phone'] ?? '') ?>" autocomplete="tel">
                        </div>
                        <small>Utilisez le numéro associé à votre compte Mobile Money, au format +242 00 000 00 00.</small>
                    </label>

                    <button class="button-primary payment-submit" type="submit">
                        <i class="fa-solid fa-paper-plane"></i>
                        Payer <?= number_format($amount, 0, ',', ' ') ?> FCFA avec Yabetoo Pay
                    </button>
                </form>

                <div class="payment-footnote">
                    <span><i class="fa-solid fa-lock"></i> Paiement sécurisé</span>
                    <span>Mode : <?= $mode === 'sandbox' ? 'test (sandbox)' : 'production' ?></span>
                </div>
                <a class="payment-back-link" href="dashboard.php"><i class="fa-solid fa-arrow-left"></i> Retourner compléter mon portfolio</a>
            <?php endif; ?>
        </div>
    </section>
</div>

<?php require __DIR__ . '/includes/footer.php'; ?>