<?php

/**
 * Configuration Yabetoo Pay
 * La clé secrète ne doit jamais être affichée dans le navigateur.
 */

return [

    // Account ID de ton compte Yabetoo Pay
    'account_id' => trim(
        (string)(getenv('YABETOO_ACCOUNT_ID') ?: 'acct_01M2TS1XPZF0NEHEXF4HC3R86D')
    ),

    // Clé secrète API
    // INSÈRE TA NOUVELLE CLÉ SECRÈTE DANS LE FICHIER .env
    'secret_key' => trim(
        (string)(getenv('YABETOO_SECRET_KEY') ?: '')
    ),

    // Mode de paiement : sandbox pour les tests
    'mode' => getenv('YABETOO_MODE') ?: 'sandbox',

    // Prix de publication en FCFA
    'publication_amount' => (int)(
        getenv('YABETOO_PUBLICATION_AMOUNT') ?: 5000
    ),

];
