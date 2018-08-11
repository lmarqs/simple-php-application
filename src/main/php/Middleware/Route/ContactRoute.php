<?php
namespace lmarqs\Spa\Middleware\Route;

use lmarqs\Spa\Middleware\Handler;
use lmarqs\Spa\Middleware\Request;

class ContactRoute extends Handler
{
    public function __construct()
    {
        $this->add('([0-9]+)', function ($request, $response, $next, $matches) {
            $response
                ->write($request->method())
                ->write('contact/')
                ->write($matches[0])
                ->send();
        });

        $this->add('', function ($request, $response, $next, $matches) {

            if ($request->method() != Request::METHOD_GET) {
                $response->send(405);
                return;
            }

            $response
                ->write('contacts')
                ->write($matches[0])
                ->send();
        });

    }
}
