<?php
namespace lmarqs\Spa\Middleware\Route;

use lmarqs\Spa\Middleware\Handler;

class LogoutRoute extends Handler
{
    public function __construct()
    {

        $this->add('', function ($request, $response) {
            session_start();
            session_unset();
            session_destroy();
            $response->setHeader('Location', '/')->send();
        });

    }
}
