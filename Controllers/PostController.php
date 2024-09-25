<?php

class PostController extends Controller
{

    
    // Afficher le formulaire pour créer un post
    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_SESSION['user_id']; // Assure-toi que l'utilisateur est authentifié et que user_id est en session
            $title = htmlspecialchars($_POST['title']);
            $content = htmlspecialchars($_POST['content']);

            // Validation
            if (empty($title) || empty($content)) {
                echo "Le titre et le contenu sont requis.";
                return;
            }
            // Créer le post
            $result = PostRepository::createPost($userId, $title, $content);
            if ($result) {
                header('Location: /dashboard'); // Redirection après la création du post
                exit();
            } else {
                echo "Erreur lors de la création du post.";
            }

            
        }
        require_once("../views/post.php");
    }
}