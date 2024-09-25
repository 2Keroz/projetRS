<?php
class Router
{
    public function start()
    {
        try {
            $url = $_SERVER["REQUEST_URI"];
            $method = $_SERVER["REQUEST_METHOD"];
            
            if ($url !== "/") {
                $parts = explode("/", $url);
                $controllerName = ucfirst($parts[1]) . "Controller";

                if (class_exists($controllerName)) {
                    $controller = new $controllerName();

                    // Vérifier s'il y a une méthode spécifique à appeler
                    if (isset($parts[2]) && method_exists($controller, $parts[2])) {
                        $method = $parts[2];
                        $controller->$method();
                    } elseif (method_exists($controller, "index")) {
                        $controller->index();
                    } else {
                        throw new Exception("Pas de méthode index dans ce controller.", 1);
                    }
                } else {
                    throw new Exception("Cette page n'existe pas.", 1);
                }
            } else {
                $controller = new MainController();
                $controller->index();
            }
        } catch (Exception $e) {
            require_once(__DIR__ . "/views/error_404.php");
        }
    }
}
