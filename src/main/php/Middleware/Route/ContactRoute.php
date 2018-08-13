<?php
namespace lmarqs\Spa\Middleware\Route;

use lmarqs\Spa\Controller\ContactController;
use lmarqs\Spa\Middleware\Handler;
use lmarqs\Spa\Middleware\Request;

class ContactRoute extends Handler
{
    public function __construct()
    {

        $this->add('', function ($request, $response, $next) {
            if ($request->method() == Request::METHOD_GET || $request->method() == Request::METHOD_POST) {
                $next();
            } else {
                $response->send(405);
            }
        });

        $this->add('create', function ($request, $response, $next) {
            $request->setAttribute('id', '0');
            $next();
        });

        $this->add('([0-9]+)', function ($request, $response, $next, $matches) {
            $request->setAttribute('id', $matches[0]);
            $next();
        });

        $this->add('', function ($request, $response, $next, $matches) {
            ContactController::processRequest($request, $response);
        });

    }
}
