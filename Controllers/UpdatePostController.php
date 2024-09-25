<?php

class UpdatePostController extends Controller
{
    public function index() 
{
    if (!isset($_SESSION['user_id'])) {
        header("Location: /main");
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['post_id'], $_POST['title'], $_POST['content'])) {
        $postId = $_POST['post_id'];
        $newTitle = $_POST['title'];
        $newContent = $_POST['content'];

        $result = PostRepository::updatePost($postId, $_SESSION['user_id'], $newTitle, $newContent);

        if ($result) {
            $_SESSION['message'] = "Post mis à jour avec succès.";
        } else {
            $_SESSION['error'] = "Erreur lors de la mise à jour du post.";
        }

        header("Location: /dashboard");
        exit();
    } else {
        $_SESSION['error'] = "Données invalides pour la mise à jour du post.";
        header("Location: /dashboard");
        exit();
    }
}
}