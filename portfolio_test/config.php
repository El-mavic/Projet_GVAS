
<?php

// =====================================================
// 1. CHARGEMENT DU FICHIER .ENV
// =====================================================

$envFile = __DIR__ . '/.env';

if (is_file($envFile) && is_readable($envFile)) {

    $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    foreach ($lines as $line) {

        $line = trim($line);

        // Ignorer les commentaires
        if ($line === '' || strpos($line, '#') === 0) {
            continue;
        }

        // Séparer le nom et la valeur
        if (strpos($line, '=') === false) {
            continue;
        }

        [$name, $value] = explode('=', $line, 2);

        $name = trim($name);
        $value = trim($value);

        // Retirer les guillemets éventuels
        if (
            strlen($value) >= 2 &&
            (($value[0] === '"' && substr($value, -1) === '"') ||
                ($value[0] === "'" && substr($value, -1) === "'"))
        ) {
            $value = substr($value, 1, -1);
        }

        // Ne pas écraser une variable déjà définie sur le serveur
        if ($name !== '' && getenv($name) === false) {
            putenv($name . '=' . $value);
            $_ENV[$name] = $value;
            $_SERVER[$name] = $value;
        }
    }
}


// =====================================================
// 2. DEMARRAGE DE LA SESSION
// =====================================================

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}


// =====================================================
// 3. CONNEXION A LA BASE DE DONNEES
// =====================================================

$host = getenv('DB_HOST') ?: 'localhost';
$dbname = getenv('DB_NAME') ?: 'port_folio_db';
$username = getenv('DB_USER') ?: 'root';
$password = getenv('DB_PASS') ?: '';

try {

    $pdo = new PDO(
        "mysql:host={$host};dbname={$dbname};charset=utf8mb4",
        $username,
        $password,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]
    );
} catch (PDOException $e) {

    error_log('[Database] ' . $e->getMessage());

    http_response_code(500);

    exit('Connexion à la base de données impossible. ' .
        'Vérifiez les paramètres de connexion.');
}


// =====================================================
// 4. FONCTION DE SECURISATION HTML
// =====================================================

if (!function_exists('e')) {

    function e($value): string
    {
        return htmlspecialchars(
            (string)$value,
            ENT_QUOTES,
            'UTF-8'
        );
    }
}
