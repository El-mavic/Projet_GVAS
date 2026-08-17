<?php
$host = 'localhost';
$db = 'gvas';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

function db(): PDO {
    global $host, $db, $user, $pass, $charset;
    return new PDO(
        "mysql:host=$host;dbname=$db;charset=$charset",
        $user,
        $pass,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );
}
