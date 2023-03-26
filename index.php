<?php
session_start();
require_once "BaseController.php";
require_once "BaseModel.php";
try {
    foreach (glob(__DIR__ . '/models/*.php') as $model_file) {
        require_once $model_file;
    }
} catch (Throwable $e) {
    $error = $e->getMessage();
    exit();
}

// Define the routes
require_once "routes.php";

//// Check if the requested URL is a valid route
//if (array_key_exists($uri, $routes)) {
//    $route = $routes[$uri];
//    $route_parts = explode('@', $route);
//    $controller = $route_parts[0];
//    $method = $route_parts[1];
//
//    // Load the controller and call the appropriate method
//    require_once('controllers/' . $controller . '.php');
//    $controller_instance = new $controller();
//    $controller_instance->$method();
//} else {
//    // Display a 404 error page
//    header('HTTP/1.0 404 Not Found');
//    echo '404 Not Found';
//}

$uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2);
$uri = $uri_parts[0];

foreach ($routes as $route => $handler) {
    // Replace placeholders with regex patterns to match dynamic parts
    $route_regex = str_replace('/', '\/', $route);
    $route_regex = preg_replace('/:(\w+)/', '(?P<$1>[^\/]+)', $route_regex);
    $route_regex = '/^' . $route_regex . '$/';

    // Check if the current URI matches the route pattern
    if (preg_match($route_regex, $uri, $matches)) {
        $handler_parts = explode('@', $handler);
        $controller = $handler_parts[0];
        $method = $handler_parts[1];

        // Load the controller and call the appropriate method with the dynamic parts as arguments
        require_once('controllers/' . $controller . '.php');
        $controller_instance = new $controller();
        $args = array_intersect_key($matches, array_flip(array_filter(array_keys($matches), 'is_string')));
        $controller_instance->$method(...$args);
        exit();
    }
}

// Display a 404 error page if no matching route was found
header('HTTP/1.0 404 Not Found');
echo '404 Not Found';

