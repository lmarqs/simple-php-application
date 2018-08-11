<?php

namespace lmarqs\Spa\Middleware;

class Handler
{

    public $handlers = [];

    public function add($path, $callable)
    {
        $this->handlers[] = [
            'path' => $path,
            'callable' => $callable,
        ];
    }

}
