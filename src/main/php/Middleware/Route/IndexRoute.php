<?php
namespace lmarqs\Spa\Middleware\Route;

use lmarqs\Spa\Controller\IndexController;
use lmarqs\Spa\Middleware\Handler;
use lmarqs\Spa\Middleware\Route\Api\ApiRoute;

class IndexRoute extends Handler
{
    public function __construct()
    {

        $this->add('api', new ApiRoute());
        $this->add('contact', new ContactRoute());
        $this->add('login', new LoginRoute());

        $this->add('', function ($request, $response) {
            IndexController::processRequest($request, $response);
        });
    }
}
