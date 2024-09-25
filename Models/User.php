<?php
class User extends UserRepository
{
    private $id;
    private $username;
    private $email;
    private $password;
    private $msg; // Variable pour les messages d'erreur

    public function __construct($id, $username, $email, $password)
    {
        $this->id = $id;
        $this->setUsername($username);
        $this->setEmail($email);
        $this->setPassword($password);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $username_regex = '/^[a-zA-Z0-9]+$/';
        if (preg_match($username_regex, $username)) {
            if (UserRepository::usernameExists($username)) {
                $this->msg = "Ce nom d'utilisateur est déjà utilisé.";
            } else {
                $this->username = $username;
            }
        } else {
            $this->msg = "Nom d'utilisateur invalide. Il doit contenir uniquement des lettres et des chiffres.";
        }
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $email_regex = '/^[\w._%+-]+@[\w.-]+\.[a-zA-Z]{2,}$/';
        if (preg_match($email_regex, $email)) {
            if (UserRepository::emailExists($email)) {
                $this->msg = "Cette adresse email est déjà utilisée.";
            } else {
                $this->email = $email;
            }
        } else {
            $this->msg = "Adresse email invalide.";
        }
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $this->password = $hashedPassword;
    }    

    public function getMessage()
    {
        return $this->msg;
    }
}
