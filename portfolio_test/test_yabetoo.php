<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/config.php';

echo "<h3>Diagnostic Yabetoo Pay</h3>";

echo "1. Fichier .env : ";

echo is_file(__DIR__ . '/.env')
    ? "Trouvé"
    : "Introuvable";

echo "<br><br>2. Clé secrète : ";

echo getenv('YABETOO_SECRET_KEY') !== false
    && trim(getenv('YABETOO_SECRET_KEY')) !== ''
    ? "Chargée"
    : "Non chargée";

echo "<br><br>3. Account ID : ";

echo getenv('YABETOO_ACCOUNT_ID') !== false
    && trim(getenv('YABETOO_ACCOUNT_ID')) !== ''
    ? "Chargé"
    : "Non chargé";

echo "<br><br>4. Configuration Yabetoo : ";

$config = require __DIR__ . '/config/yabetoo.php';

echo !empty($config['secret_key'])
    ? "Clé récupérée"
    : "Clé absente";
