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
            $uri = $_SERVER['REQUEST_URI'];
            $method = $_SERVER['REQUEST_METHOD'];
            $paths = explode('/',$uri,3);

            $path =  $paths[2];
            // echo '<pre>';
            //     var_dump($paths);
            //     echo '</pre>'; 
            foreach ($this->routes as $route) {
                // echo '<pre>';
                // var_dump($route['path']);
                // echo '</pre>';  
                if ($path == $route['path'] && $method === $route['method']) {
                    
                    // echo '<pre>';
                    // var_dump($route['controller']);
                    // echo '</pre>';
                    $controller = "App\\Controllers\\" . $route['controller'];
                    echo "<br>";
                    
                    echo $controller;
                    echo "<br>";
                    echo $route['path'];

                    if (class_exists($controller)) {
                        $action = $route['action']; 
                        echo '<br>';
                        echo $action;
                        echo '<br>';
                        
$email = "mohamed@gmail.com";
$User = new User;
$result =  $User->read($email);
                        // var_dump($result);
                        $controllerInstance = new $controller($result);
                        
                        if (method_exists($controllerInstance, $action)) {
                            echo '<br>';
                            echo $controller;
                            echo '<br>';

                            return $controllerInstance->$action();
                        }
                    }
                }
            }
            
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

