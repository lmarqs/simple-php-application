<?php
namespace lmarqs\Spa\Middleware\Route;

use lmarqs\Spa\Middleware\Request;

class Index extends Route
{
    public function __construct()
    {
        $this->add(Request::METHOD_GET, function () {
            echo 'Hello World!!!';
        });
    }
}
