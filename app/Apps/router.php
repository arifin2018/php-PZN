<?php 

namespace Arifin\PHP\MVC\apps;
// namespace app\Apps;

class router{

    private static array $routes = [];

    public static function add(string $method, string $path, string $controller, string $function): void
    {
        self::$routes = [
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

        foreach (self::$routes as $key => $value) {
            echo $value;
            // if ($path == $value['path'] && $method == $value['method']) {
            //     echo "CONTROLLER => ". $value['controller'] . PHP_EOL;
            //     echo "FUNCTION => ".$value['function'] . PHP_EOL;
            //     return;
            // }
        }

        http_response_code(404);
        echo "CONTROLLER NOT FOUND";
    }

}