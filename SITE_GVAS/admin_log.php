<?php
session_start();
$error = "";
$admin_email = "admin@gvas.com";
$admin_password = "123456"; // change ça plus tard

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($email === $admin_email && $password === $admin_password) {
        $_SESSION['admin'] = true;
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Email ou mot de passe incorrect";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Admin</title>

    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:Arial,sans-serif;
        }

        body{
            background:#f1f5f9;
            display:flex;
            justify-content:center;
            align-items:center;
            height:100vh;
        }

        .login-box{
            background:white;
            padding:40px;
            width:400px;
            border-radius:20px;
            box-shadow:0 8px 25px rgba(0,0,0,0.08);
        }

        h2{
            text-align:center;
            margin-bottom:25px;
            color:#0f172a;
        }

        input{
            width:100%;
            padding:14px;
            margin-bottom:15px;
            border:1px solid #cbd5e1;
            border-radius:10px;
            outline:none;
        }

        button{
            width:100%;
            padding:14px;
            border:none;
            background:#2563eb;
            color:white;
            font-weight:bold;
            border-radius:10px;
            cursor:pointer;
        }

        button:hover{
            background:#1d4ed8;
        }

        .error{
            color:red;
            text-align:center;
            margin-bottom:15px;
        }
    </style>
</head>
<body>

    <div class="login-box">
        <h2>Connexion Administrateur</h2>

        <?php if($error): ?>
            <p class="error"><?= $error ?></p>
        <?php endif; ?>

        <form method="POST">
            <input type="email" name="email" placeholder="Email admin" required>
            <input type="password" name="password" placeholder="Mot de passe" required>
            <button type="submit">Se connecter</button>
        </form>
    </div>

</body>
</html>