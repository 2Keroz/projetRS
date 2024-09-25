<?php

abstract class UserRepository extends db
{
    private static function request($request, $params)
    {
        $stmt = self::getInstance()->prepare($request);
        $stmt->execute($params);
        self::disconnect();
        return $stmt;
    }

    // Vérifie si l'username existe déjà
    public static function usernameExists($username)
    {
        $sql = "SELECT COUNT(*) FROM users WHERE username = ?";
        $count = self::request($sql, [$username], true);
        return $count > 0;
    }

    // Vérifie si l'email existe déjà
    public static function emailExists($email)
    {
        $sql = "SELECT COUNT(*) FROM users WHERE email = ?";
        $count = self::request($sql, [$email], true);
        return $count > 0;
    }
    public static function CreateUser($username, $email, $password)
    {
        // Utilisez des requêtes préparées pour éviter les injections SQL
        $request = "INSERT INTO users (username,email, password) VALUES (?, ?, ?);";
        $params = [$username, $email, $password];
        return self::request($request, $params);
    }

    public static function getUserByName($username)
    {
        try {
            $db = Db::getInstance();
            $stmt = $db->prepare("SELECT * FROM users WHERE username = :username");
            $stmt->execute(['username' => $username]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error fetching user: " . $e->getMessage();
            return null;
        }
    }
}
