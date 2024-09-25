<?php

class EditPostController extends Controller
{
    public function index() 
{
    if (!isset($_SESSION['user_id'])) {
        header("Location: /main");
        exit();
    }

    $postId = isset($_GET['id']) ? $_GET['id'] : null;

    if (!$postId) {
        $_SESSION['error'] = "Aucun post sélectionné pour modification.";
        header("Location: /dashboard");
        exit();
    }

    $post = PostRepository::getPostById($postId, $_SESSION['user_id']);

    if (!$post) {
        $_SESSION['error'] = "Le post n'existe pas ou vous n'avez pas la permission de le modifier.";
        header("Location: /dashboard");
        exit();
    }

    require_once("views/edit_post.php");
}
}