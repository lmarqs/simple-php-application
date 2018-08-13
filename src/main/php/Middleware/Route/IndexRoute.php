<?php
namespace lmarqs\Spa\Middleware\Route;

use lmarqs\Spa\Middleware\Handler;
use lmarqs\Spa\Middleware\Route\Api\ApiRoute;

class IndexRoute extends Handler
{
    public function __construct()
    {

        $this->add('login', new LoginRoute());
        $this->add('logout', new LogoutRoute());

        $this->add('', $this->loggedInFilter());

        $this->add('api', new ApiRoute());
        $this->add('contact', new ContactRoute());

        $this->add('', function ($request, $response) {
            $response->setHeader('Location', '/contact')->send();
        });

    }

    private function loggedInFilter()
    {
        return function ($request, $response, $next) {
            session_start();
            if (isset($_SESSION["username"])) {
                $next();
                return;
            }
            $response->setHeader('Location', '/login')->send();
        };
    }

}
