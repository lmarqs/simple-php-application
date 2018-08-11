<?php
namespace lmarqs\Spa\Middleware\Route;

use lmarqs\Spa\Middleware\Handler;

class LoginRoute extends Handler
{
    public function __construct()
    {

        $this->add('', function ($request, $response, $next) {
            $response->write('login route')->send();
        });

    }
}
