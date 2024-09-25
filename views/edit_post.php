<?php
// Vérifie que l'utilisateur est connecté et que le post est disponible
if (!isset($_SESSION['user_id']) || !isset($post)) {
    header("Location: /main");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un post</title>
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
            max-width: 600px;
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
        input, textarea {
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
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Modifier le post</h2>
        <form action="/update_post" method="POST">
            <input type="hidden" name="post_id" value="<?php echo htmlspecialchars($post['id']); ?>">

            <label for="title">Titre :</label>
            <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($post['title']); ?>" required>

            <label for="content">Contenu :</label>
            <textarea id="content" name="content" rows="6" required><?php echo htmlspecialchars($post['content']); ?></textarea>

            <button type="submit">Mettre à jour</button>
        </form>
    </div>
</body>
</html>
