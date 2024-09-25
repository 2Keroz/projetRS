<?php

class PostRepository extends db {

    // Méthode pour exécuter les requêtes SQL
    private static function request($request, $params)
    {
        try {
            $stmt = self::getInstance()->prepare($request);
            $stmt->execute($params);
            self::disconnect();
            return $stmt;
        } catch (PDOException $e) {
            echo "Erreur SQL : " . $e->getMessage();
            return false;
        }
    }

    public static function createPost($userId, $title, $content) {
        $sql = "INSERT INTO posts (user_id, title, content, created_at) VALUES (?, ?, ?, NOW())";
        $params = [$userId, $title, $content];
        return self::request($sql, $params);
    }
    
    

    // Récupérer tous les posts d'un utilisateur spécifique
    public static function getUserPosts($userId) {
        $sql = "SELECT * FROM posts WHERE user_id = ? ORDER BY created_at DESC";
        $stmt = self::request($sql, [$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupérer tous les posts (posts des autres utilisateurs)
        public static function getAllPosts() {
            $sql = "SELECT posts.*, users.username FROM posts 
                    JOIN users ON posts.user_id = users.id 
                    ORDER BY posts.created_at DESC";
            $stmt = self::request($sql, []);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public static function deletePost($postId, $userId) {
            $sql = "DELETE FROM posts WHERE id = ? AND user_id = ?";
            $params = [$postId, $userId];
            $result = self::request($sql, $params);
            if ($result && $result->rowCount() > 0) {
                return true;
            }
            return false;
        }

        public static function getPostById($postId, $userId) {
            $sql = "SELECT * FROM posts WHERE id = ? AND user_id = ?";
            $stmt = self::request($sql, [$postId, $userId]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        
        public static function updatePost($postId, $userId, $newTitle, $newContent) {
            $sql = "UPDATE posts SET title = ?, content = ? WHERE id = ? AND user_id = ?";
            $params = [$newTitle, $newContent, $postId, $userId];
            return self::request($sql, $params);
        }
        
}
