<?php 

namespace Arifin\PHP\MVC\apps;
// namespace app\Apps;

class router{

    private static array $routes = [];

    public static function add(string $method, string $path, string $controller, string $function): void
    {
        self::$routes[] = [
            'method' => $method,
            'path' => $path,
            'controller' => $controller,
            'function' => $function,
        ];
    }

    public static function run(): void
    {
        $path = '/';

        if (isset($_SERVER['PATH_INFO'])) {
            $path = $_SERVER['PATH_INFO'];
        }

        $method = $_SERVER['REQUEST_METHOD'];


        foreach (self::$routes as $key => $routes) {
            $pattern = "#^". $routes['path'] ."$#";
            // if ($path == $routes['path'] && $method == $routes['method']) {
                if (preg_match($pattern, $path, $route) && $method == $routes['method']) {
                    $controller = new $routes['controller'];
                    $nameFunction = $routes['function'];

                    $controller->$nameFunction();
                    return;
                }
            }
        http_response_code(404);
        echo "CONTROLLER NOT FOUND";
    }

}