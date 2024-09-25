<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S'inscrire</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px; /* Ajustement pour un bon centrage */
            box-sizing: border-box;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 24px;
            font-weight: bold;
        }
        label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
        }
        input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }
        button {
            width: 100%;
            padding: 12px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #218838;
        }

        .msg {
            color: red;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Inscription</h2>
        <form action="/register" method="POST">
            <label for="username">Nom d'utilisateur :</label>
            <input type="text" id="username" name="username" value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">

            <label for="email">Email :</label>
            <input type="email" id="email" name="email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">

            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password">

            <label for="confirm_password">Confirmez le mot de passe :</label>
            <input type="password" id="confirm_password" name="confirm_password">

            <button type="submit">S'inscrire</button>
            <div class="msg"><?php if (isset($msg)) echo htmlspecialchars($msg); ?></div>
        </form>
    </div>
</body>
</html>
