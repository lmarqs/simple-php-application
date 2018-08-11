<?php

namespace lmarqs\Spa\Middleware;

use lmarqs\Spa\Core\Logger;

class Router
{

    private $routes;

    public function __construct($route)
    {
        $this->routes = $route->toArray();
    }

    public function run()
    {

        $request = new Request();
        $response = new Response();

        $path = $request->path();
        $method = $request->method();

        $route_match_found = false;

        foreach ($this->routes as $expression => $route) {

            Logger::getInstance()->i('ROUTER', $path);

            if (preg_match('/^' . $expression . '/', $path, $matches)) {

                $route_match_found = true;

                if (!isset($route->handles[$method])) {
                    // todo: use response
                    header('HTTP/1.0 405 Method Not Allowed');
                    Logger::getInstance()->i('ROUTER', 'HTTP/1.0 405 Method Not Allowed');
                    break;
                }

                $continue = false;
                $next = function ($error) {
                    if (!$error) {
                        $continue = true;
                    }
                };

                try {
                    array_shift($matches); // Remove first element that contains the whole string
                    call_user_func_array($route->handles[$method], [$request, $response, $matches, $next]);
                } catch (Exception $e) {
                    Logger::getInstance()->e('ROUTER', $e->getMessage());
                }

                if (!$continue) {
                    break;
                }
            }

        }

        if (!$route_match_found) {
            header('HTTP/1.0 404 Not Found');
            Logger::getInstance()->i('ROUTER', 'HTTP/1.0 404 Not Found');
        }

    }

}
