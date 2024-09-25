<?php
class RegisterController extends Controller
{
    public function index()
    {

        // Vérifiez si l'utilisateur est déjà connecté
        if (isset($_SESSION['user_id'])) {
            header("Location: /dashboard");
            exit();
        }

        $msg = ''; // Initialisation de la variable $msg

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Récupérez et assainissez les données du formulaire
            $username = htmlspecialchars($_POST['username']);
            $email = htmlspecialchars($_POST['email']);
            $password = htmlspecialchars($_POST['password']);
            $confirm_password = htmlspecialchars($_POST['confirm_password']);

            // Créez un objet User
            $user = new User(null, $username, $email, $password);

            // Vérifiez les messages d'erreur
            $msg = $user->getMessage();

            // Vérifiez si les mots de passe correspondent
            if ($password !== $confirm_password) {
                $msg = "Les mots de passe ne correspondent pas.";
            }

            if (empty($msg)) {
                try {
                    // Récupérez le mot de passe haché depuis l'objet User
                    $hashedPassword = $user->getPassword();
            
                    // Créez l'utilisateur avec le mot de passe haché
                    UserRepository::CreateUser($username, $email, $hashedPassword);

                    // Récupérez l'ID de l'utilisateur nouvellement créé
                    $newUser = UserRepository::getUserByName($username);
                    $_SESSION['user_id'] = $newUser['id'];
                    $_SESSION['username'] = $newUser['username'];

                    // Redirection vers le tableau de bord
                    header("Location: /dashboard");
                    exit(); // Assurez-vous de sortir après la redirection
                } catch (PDOException $e) {
                    if ($e->getCode() == '23000') {
                        $msg = "Nom d'utilisateur ou adresse email déjà pris.";
                    } else {
                        $msg = "Une erreur est survenue lors de l'inscription. Veuillez réessayer.";
                    }
                }
            }
        }

        // Inclure la vue et passer la variable $msg
        require_once(__DIR__ . "/../views/register.php");
    }
}
