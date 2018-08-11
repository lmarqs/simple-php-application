<?php

namespace lmarqs\Spa\Core;

use lmarqs\Spa\Middleware\Request;
use lmarqs\Spa\Middleware\Response;
use lmarqs\Spa\Middleware\Router;
use lmarqs\Spa\Middleware\Route\IndexRoute;

class Application
{
    use SingletonTrait;

    public function init()
    {
        $this->router = new Router();
    }

    public function run()
    {
        Logger::getInstance()->i('APPLICATION', 'Application::run');
        $this->router->run(new Request(), new Response(), new IndexRoute());

    }
}
