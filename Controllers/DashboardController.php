<?php
class DashboardController extends Controller
{
    public function index()
    {
        // Vérifiez que l'utilisateur est connecté
        if (!isset($_SESSION['user_id'])) {
            header("Location: /login");
            exit();
        }

        // Récupérer tous les posts (des autres utilisateurs et de l'utilisateur connecté)
        $allPosts = PostRepository::getAllPosts();

        // Chargez la vue du tableau de bord
        require_once("../views/dashboard.php");
    }
}
