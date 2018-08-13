<?php
namespace lmarqs\Spa\Middleware\Route\Api;

use lmarqs\Spa\Middleware\Handler;

class ApiRoute extends Handler
{
    public function __construct()
    {
        $this->add('contact', new ContactRoute());
    }
}
