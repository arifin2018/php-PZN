<?php 

namespace Arifin\PHP\MVC\Apps;

class Router{

    private static array $routes = [];

    public static function add(string $method, string $path, string $controller, string $function, array $middleware = []): void
    {
        self::$routes[] = [
            'method' => $method,
            'path' => $path,
            'controller' => $controller,
            'function' => $function,
            'middleware' => $middleware,
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

                foreach ($routes['middleware'] as $keyiddleware => $middleware) {
                    if ($middleware != []) {
                        $classMiddleware = new $middleware;
                        $classMiddleware->before();
                    }
                }

                $controller = new $routes['controller'];
                $nameFunction = $routes['function'];
                array_shift($route);
                call_user_func_array([$controller,$nameFunction],$route);
                return;
            }
        }
        http_response_code(404);
        echo "CONTROLLER NOT FOUND";
    }

    public static function ok(): string
    {
        return 'ok';
    }

}