<!-- ?php
 Configuration Yabetoo Pay : la clé secrète reste exclusivement côté serveur. */
return [
    'secret_key' => getenv('YABETOO_SECRET_KEY') ?: 'REMPLACER_PAR_VOTRE_CLE_SECRETE',
    // sandbox pour les tests ; production pour les paiements réels.
    'mode' => getenv('YABETOO_MODE') ?: 'sandbox',
    // Prix de publication en FCFA, modifiable ici.
    'publication_amount' => (int)(getenv('YABETOO_PUBLICATION_AMOUNT') ?: 1000),
]; -->



<?php

/**
 * Configuration Yabetoo Pay
 * Mode de test local pour le développement.
 */

return [
    // Clé secrète utilisée uniquement pour les paiements réels.
    'secret_key' => getenv('YABETOO_SECRET_KEY')
        ?: 'REMPLACER_PAR_VOTRE_CLE_SECRETE',

    // Mode de paiement : sandbox ou production.
    'mode' => getenv('YABETOO_MODE') ?: 'sandbox',

    // Prix de publication en FCFA.
    'publication_amount' => (int)(
        getenv('YABETOO_PUBLICATION_AMOUNT') ?: 1000
    ),

    // TEST LOCAL : simule la confirmation du paiement.
    // À désactiver impérativement avant la mise en ligne.
    'local_test' => true,
];
