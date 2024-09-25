<?php
// session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    // Redirigez vers la page de connexion si l'utilisateur n'est pas connecté
    header("Location: /main");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            background-color: #fff;
            border-bottom: 1px solid #ddd;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
        }

        .logout-button {
            padding: 8px 12px;
            background-color: #dc3545;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            text-align: center;
        }

        .logout-button:hover {
            background-color: #c82333;
        }

        .dashboard-container {
            display: flex;
            justify-content: space-between;
            padding: 20px;
            align-items: flex-start;
            /* Assure que les éléments ne s’adaptent pas à la hauteur de l’autre */
        }

        .posts-container,
        .other-users-posts-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            width: 48%;
            /* Ajuste la largeur des conteneurs */
            box-sizing: border-box;
        }

        .posts-container {
            margin-right: 2%;
            /* Pas de hauteur définie, elle grandit en fonction du contenu */
        }

        .post,
        .other-post {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 15px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .post h2,
        .other-post h2 {
            font-size: 20px;
            margin: 0 0 10px;
        }

        .post p,
        .other-post p {
            margin: 0;
        }

        .post-actions,
        .other-post-actions {
            margin-top: 10px;
            text-align: right;
        }

        .post-actions a,
        .other-post-actions a {
            margin-left: 10px;
            color: #007bff;
            text-decoration: none;
        }

        .post-actions a:hover,
        .other-post-actions a:hover {
            text-decoration: underline;
        }

        .create-post-button {
            padding: 8px 12px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            text-align: center;
            margin-right: 10px;
        }

        .create-post-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Bienvenue sur votre tableau de bord, <?php echo htmlspecialchars($_SESSION['username']); ?> !</h1>
        <div>
            <a href="/post" class="create-post-button">Créer un post</a>
            <a href="/logout" class="logout-button">Déconnexion</a>
        </div>
    </div>


    <div class="dashboard-container">
        <!-- Conteneur pour les posts de l'utilisateur connecté -->
        <div class="posts-container">
            <h2>Vos posts</h2>

            <?php
            // Récupération des posts de l'utilisateur connecté
            $userPosts = PostRepository::getUserPosts($_SESSION['user_id']);
            if ($userPosts) {
                foreach ($userPosts as $post) {
            ?>
                    <div class="post">
                        <h2><?php echo htmlspecialchars($post['title']); ?></h2>
                        <p><?php echo htmlspecialchars($post['content']); ?></p>
                        <div class="post-actions">
                            <!-- Bouton modifier a terminer, non fonctionnel pour le moment  -->
                            <!-- <form action="/editPost" method="GET" style="display: inline;">
                                <input type="hidden" name="id" value="<?php echo $post['id']; ?>">
                                <button type="submit" class="logout-button">Modifier</button>
                            </form> -->
                            <form action="/deletePost" method="POST" style="display: inline;">
                                <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
                                <button type="submit" class="logout-button" onclick="return confirm('Voulez-vous vraiment supprimer ce post ?');">Supprimer</button>
                            </form>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo "<p>Vous n'avez pas encore publié de posts.</p>";
            }
            ?>
        </div>


        <!-- Conteneur pour les posts des autres utilisateurs -->
        <div class="other-users-posts-container">
            <h2>Posts des autres utilisateurs</h2>

            <?php
            // Afficher tous les posts (y compris ceux de l'utilisateur connecté)
            if ($allPosts) {
                foreach ($allPosts as $post) {
            ?>
                    <div class="other-post">
                        <h2><?php echo htmlspecialchars($post['title']); ?></h2>
                        <p><?php echo htmlspecialchars($post['content']); ?></p>
                        <p><strong>Publié par : <?php echo htmlspecialchars($post['username']); ?></strong></p>
                        <div class="other-post-actions">
                            <!-- Si vous souhaitez ajouter d'autres actions -->
                        </div>
                    </div>
            <?php
                }
            } else {
                echo "<p>Il n'y a pas encore de posts publiés.</p>";
            }
            ?>
        </div>

    </div>
</body>

</html>