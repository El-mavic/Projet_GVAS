<?php
require __DIR__ . '/config.php';
unset($_SESSION['admin_id'], $_SESSION['admin_username'], $_SESSION['admin_csrf']);
session_regenerate_id(true);
header('Location: admin_login.php');
exit;
