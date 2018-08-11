<?php
namespace lmarqs\Spa\Middleware\Route\Api;

use lmarqs\Spa\Middleware\Handler;
use lmarqs\Spa\Middleware\Request;

class ContactRoute extends Handler
{
    public function __construct()
    {

        $this->add('', function ($request, $response, $next) {
            if ($request->method() != Request::METHOD_GET) {
                $response->send(405);
                return;
            }

            $next();
        });

        $this->add('photo/([0-9]+)', function ($request, $response, $next, $matches) {
            $response
                ->write('api/contact/photo')
                ->write($matches[0])
                ->send();
        });

        $this->add('', function ($request, $response) {
            if ($request->method() != Request::METHOD_GET) {
                $response->send(405);
                return;
            }

            $response->write('api/contact')->send();
        });

    }
}
