<?php 
class MainController extends Controller {
    public function index() {

        // Vérifiez si l'utilisateur est déjà connecté
        if (isset($_SESSION['user_id'])) {
            header("Location: /dashboard");
            exit();
        }

        // Inclure la vue de la page principale
        require_once(__DIR__ . "/../views/main.php");
    }
}
?>
