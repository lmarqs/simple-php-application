<?php

namespace lmarqs\Spa\Middleware\Route;

class Route
{
    public $routes = [];
    public $handles = [];

    public function add($expression, $handle)
    {

        if ($handle instanceof self) {
            array_push($this->$routes, [
                'expression' => $expression,
                'route' => $handle,
            ]);
        } else {
            $this->handles[$expression] = $handle;
        }

    }

    public function toArray($expression = '')
    {
        $array = [
            $expression => $this,
        ];

        foreach ($this->routes as $route) {
            $array = array_merge($array, $route->toArray($route['expression']));
        }

        return $array;
    }

}
