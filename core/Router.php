<?php
namespace Core;

use App\Models\User;
use Controllers\AuthController;

class Router {
    private $routes = [];

    public function add($method, $path, $controller, $action) {
        $this->routes[] = [
            'method' => $method,
            'path' => $path,
            'controller' => $controller,
            'action' => $action
        ];
    }

    public function dispatch() {
        $uri = $_SERVER['REQUEST_URI'];
        $uri = str_replace('/index.php', '', $uri);
        $uri = trim(parse_url($uri, PHP_URL_PATH), '/');
        $method = $_SERVER['REQUEST_METHOD'];

        foreach ($this->routes as $route) {
            // Convert {param} placeholders to regex for dynamic parameters
            $pattern = preg_replace('/\{(\w+)\}/', '(\d+)', $route['path']);
            $pattern = str_replace('/', '\/', $pattern);
            $pattern = '/^' . $pattern . '$/';

            if ($method === $route['method'] && preg_match($pattern, $uri, $matches)) {
                
                $controller = "App\\Controllers\\" . $route['controller'];

                if (class_exists($controller)) {
                    $action = $route['action'];
                    $controllerInstance = new $controller();
                    
                    if (method_exists($controllerInstance, $action)) {
                        // Remove the first element ($matches[0]) because it's the full match
                        array_shift($matches);
                        return call_user_func_array([$controllerInstance, $action], $matches);
                    }
                }
            }
        }

        // http_response_code(404);
        // echo "404 Not Found";
    }
}
