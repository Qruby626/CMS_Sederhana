<?php
class Router
{
    public function direct($uri, $method)
    {
        // Routing sederhana: /controller/method
        $uri = trim($uri, '/');
        $segments = explode('/', $uri);

        $controllerName = !empty($segments[0]) ? ucfirst($segments[0]) . 'Controller' : 'PostController';
        $methodName = isset($segments[1]) ? $segments[1] : 'index';
        $params = array_slice($segments, 2);

        $controllerFile = __DIR__ . '/../controllers/' . $controllerName . '.php';

        if (file_exists($controllerFile)) {
            require_once $controllerFile;
            if (class_exists($controllerName)) {
                $controller = new $controllerName();
                if (method_exists($controller, $methodName)) {
                    return call_user_func_array([$controller, $methodName], $params);
                } else {
                    http_response_code(404);
                    echo "Method <b>$methodName</b> tidak ditemukan di $controllerName.";
                }
            } else {
                http_response_code(404);
                echo "Controller <b>$controllerName</b> tidak ditemukan.";
            }
        } else {
            http_response_code(404);
            echo "File controller <b>$controllerFile</b> tidak ditemukan.";
        }
    }
}