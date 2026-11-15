<?php
echo '<pre>';

echo "PHP : " . PHP_VERSION . "\n";
echo "cURL : " . (extension_loaded('curl') ? 'Activé' : 'Désactivé') . "\n";
echo "OpenSSL : " . (extension_loaded('openssl') ? 'Activé' : 'Désactivé') . "\n";

$ch = curl_init('https://pay.sandbox.yabetoopay.com/v1/payment-intents');

curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 15,
]);

$response = curl_exec($ch);

if ($response === false) {
    echo "Erreur cURL : " . curl_error($ch) . "\n";
} else {
    echo "Connexion HTTPS : OK\n";
    echo "Code HTTP : " . curl_getinfo($ch, CURLINFO_HTTP_CODE) . "\n";
}

curl_close($ch);

echo '</pre>';