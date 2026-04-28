<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div id="popup" class="popup">
        <div class="popup-content">
            <div id="popup-icon" class="icon">✔</div> <!--  ID ajouté -->
            <h2 id="popup-title">Succès !</h2>
            <p id="popup-message">Message envoyé avec succès</p>
            <button onclick="closePopup()">OK</button>
        </div>
    </div>

    <style>
        .popup {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .popup-content {
            background: #fff;
            padding: 30px;
            border-radius: 15px;
            text-align: center;
            width: 300px;
            animation: fadeIn 0.3s ease;
        }

        .icon {
            font-size: 50px;
            color: green;
            margin-bottom: 10px;
        }

        .popup h2 {
            color: green;
            margin-bottom: 10px;
        }

        .popup p {
            color: #555;
            margin-bottom: 20px;
        }

        .popup button {
            background: linear-gradient(135deg, #28a745, #00c851);
            border: none;
            padding: 10px 25px;
            color: white;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
        }

        .popup button:hover {
            opacity: 0.9;
        }

        @keyframes fadeIn {
            from {
                transform: scale(0.8);
                opacity: 0;
            }

            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        .icon {
            font-size: 50px;
            margin-bottom: 10px;
        }

        /* Succès */
        .success {
            color: green;
        }

        /* Erreur */
        .error {
            color: red;
        }
    </style>


    <?php if (isset($_GET['message'])): ?>

        <script>
            let popup = document.getElementById("popup");
            let title = document.getElementById("popup-title");
            let message = document.getElementById("popup-message");
            let icon = document.getElementById("popup-icon");

            <?php if ($_GET['message'] == 'ok'): ?>
                title.innerText = "Succès !";
                message.innerText = "Message envoyé avec succès";
                icon.innerHTML = "✔";
                icon.classList.remove("error");
                icon.classList.add("success");

                title.style.color = "green";
                message.style.color = "#555";
            <?php elseif ($_GET['message'] == 'existe'): ?>
                title.innerText = "Erreur";
                message.innerText = "Je retrouve déjà ce contenu dans la base de données";
                icon.innerHTML = "❌";
                icon.classList.remove("success");
                icon.classList.add("error");

                title.style.color = "red";
                message.style.color = "red";
            <?php endif; ?>

            popup.style.display = "flex";

            function closePopup() {
                window.location.href = "index.php";
            }
        </script>
    <?php endif; ?>
</body>

</html>