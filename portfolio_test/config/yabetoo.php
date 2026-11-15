
<?php

/**
 * Configuration Yabetoo Pay
 * Les informations sensibles sont conservées dans .env.
 */

$accountId = trim((string) getenv('YABETOO_ACCOUNT_ID'));
$secretKey = trim((string) getenv('YABETOO_SECRET_KEY'));
$mode = strtolower(trim((string) (getenv('YABETOO_MODE') ?: 'sandbox')));
$amount = (int) (getenv('YABETOO_PUBLICATION_AMOUNT') ?: 10000);

// Vérification du mode
if (!in_array($mode, ['sandbox', 'production'], true)) {
    throw new RuntimeException('Mode Yabetoo Pay invalide.');
}

// Vérification des paramètres obligatoires
if ($accountId === '' || $secretKey === '') {
    throw new RuntimeException(
        'Configuration Yabetoo Pay incomplète. Vérifiez le fichier .env.'
    );
}

// Vérification du montant
if ($amount !== 10000) {
    throw new RuntimeException(
        'Le montant de publication doit être de 10 000 FCFA.'
    );
}

return [
    'account_id' => $accountId,
    'secret_key' => $secretKey,
    'mode' => $mode,
    'publication_amount' => $amount,
    'currency' => 'XAF',
];
