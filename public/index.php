<?php
session_start();
require_once("../Db.php");
require_once("../Router.php");
require_once("../Controllers/Controller.php");
require_once("../Controllers/MainController.php");
require_once("../Controllers/RegisterController.php");
require_once("../repositories/UserRepository.php");
require_once("../Models/User.php");
require_once("../Controllers/LoginController.php");
require_once("../Controllers/DashboardController.php");
require_once("../Controllers/LogoutController.php");
require_once("../Controllers/PostController.php");
require_once("../repositories/PostRepository.php");
require_once("../Controllers/DeletePostController.php");
require_once("../Controllers/EditPostController.php");
require_once("../Controllers/UpdatePostController.php");
require_once("../Models/Post.php");


try {
    $app = new Router;
    $app->start();
} catch (PDOException $e) {
    die($e->getMessage());
}
