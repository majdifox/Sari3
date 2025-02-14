<?php



// mhm logic howa ghadi n9lb 3la data dyl user n user::read($id);
// mn b3d 3la 7sab  role ghadi n3yto 3la controller
// $user = user::read($id)
// $role = $user['role'];
// switch ($role) {
//     case 'Conducteur':
//        hna controller 3la 7sab cas
    //     $controller = new ConducteurController();
//         break;
//     case 'Expediteur':
//        hna controller 3la 7sab cas
    //     $controller = new ExpediteurController();

//         break;
//     case 'Admin':
//        hna controller 3la 7sab cas
    //     $controller = new AdminController();

//         break;
    
//     default:
//        hna controller 3la 7sab cas
    //       $controller = new AuthController();
//         break;
// }

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
            // Remove index.php from the URL
            $uri = $_SERVER['REQUEST_URI'];
            $path = explode('/',$uri);
            $id = end($path);
            $uri = str_replace('/index.php', '', $uri);
            $uri = trim(parse_url($uri, PHP_URL_PATH), '/');
            $method = $_SERVER['REQUEST_METHOD'];
            
            foreach ($this->routes as $route) {
                $pattern = preg_replace('/\{(\w+)\}/', '(?P<$1>\d+)', $route['path']);
                $pattern = str_replace('/', '\/', $pattern);
                $pattern = '/^' . $pattern . '$/';
        
                if ($method === $route['method'] && preg_match($pattern, $uri, $matches)) {
                    $controller = "App\\Controllers\\" . $route['controller'];
                    
                    if (class_exists($controller)) {
                        $action = $route['action'];
                        $controllerInstance = new $controller();
                        
                        if (method_exists($controllerInstance, $action)) {
                            $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                            // echo $id;
                            return $controllerInstance->$action($id);
                        }
                    }
                }
            }
        
            // http_response_code(404);
            // echo "404 Not Found";
        }
        
        

        private function matchRoute($uri, $path) {
 

    // Convert route path pattern (e.g., "/Cabinet/index.php/medecin/{id}") to a regex
    $pattern = preg_replace('/\{(\w+)\}/', '(?P<\1>\d+)', $path); // Named group for parameters
    $pattern = str_replace('/', '\/', $pattern); // Escape slashes
    $pattern = '/^' . $pattern . '$/'; // Wrap in regex delimiters

    // Perform regex match
    if (preg_match($pattern, $uri, $matches)) {
        return true;
    }

       

    return false;
}

        
        
        
    }

