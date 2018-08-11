<?php
namespace lmarqs\Spa\Middleware\Route\Api;

use lmarqs\Spa\Middleware\Handler;

class ApiRoute extends Handler
{
    public function __construct()
    {

        $this->add('', function ($request, $response, $next) {
            $response->write('filter');
            $next();
            return;

            if (session_status() == PHP_SESSION_ACTIVE && $_SESSION['logged_in'] == true) {
                $next();
            } else {
                $response->send(404);
            }
        });

        $this->add('', function ($request, $response, $next) {
            $response->write('api');
            $next();
        });

        $this->add('contact', new ContactRoute());
    }
}
