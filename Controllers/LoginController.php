<?php
class LoginController extends Controller {
    public function index() {

        // Vérifiez si l'utilisateur est déjà connecté
        if (isset($_SESSION['user_id'])) {
            header("Location: /dashboard");
            exit();
        }

        $msg = ''; // Initialisez la variable $msg pour stocker les messages d'erreur

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = htmlspecialchars($_POST['username']);
            $password = htmlspecialchars($_POST['password']);
        
            // Récupérer l'utilisateur par nom d'utilisateur
            $user = UserRepository::getUserByName($username);
        
            if ($user) {
                // Le mot de passe est haché dans la base de données
                $hashedPassword = $user['password'];
        
                // Utilisez password_verify() pour comparer le mot de passe non haché avec le mot de passe haché
                if (password_verify($password, $hashedPassword)) {
                    // Mot de passe correct
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];
        
                    header("Location: /dashboard");
                    exit();
                } else {
                    $msg = "Mot de passe incorrect.";
                }
            } else {
                $msg = "Utilisateur non trouvé.";
            }
        }
        
        // Inclure la vue de la page de connexion avec le message d'erreur
        require_once "../views/login.php";
    }
}

    