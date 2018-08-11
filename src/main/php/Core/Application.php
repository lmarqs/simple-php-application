<?php

namespace lmarqs\Spa\Core;

use lmarqs\Spa\Middleware\Router;
use lmarqs\Spa\Middleware\Route\Index;

class Application
{
    use SingletonTrait;

    public function init()
    {
        $this->router = new Router(new Index());
    }

    public function run()
    {
        Logger::getInstance()->i('APPLICATION', 'Application::run');
        $this->router->run();
    }
}
