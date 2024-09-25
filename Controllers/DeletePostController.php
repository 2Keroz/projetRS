<?php
    class DeletePostController extends Controller
    {
        public function index()
        {
            // Vérifie que le post_id est bien envoyé via le formulaire
            if (isset($_POST['post_id'])) {
                $postId = $_POST['post_id'];
                $userId = $_SESSION['user_id']; // Assure-toi que l'utilisateur est connecté et que user_id est dans la session
    
                // Appelle la méthode pour supprimer le post
                $result = PostRepository::deletePost($postId, $userId);
    
                if ($result) {
                    // Redirection vers la page d'accueil si la suppression réussit
                    header('Location: /dashboard');
                    exit();
                } else {
                    // Affiche un message d'erreur si la suppression échoue
                    echo "Erreur lors de la suppression du post.";
                }
            } else {
                echo "Erreur : aucun post spécifié.";
            }
        }
    }

