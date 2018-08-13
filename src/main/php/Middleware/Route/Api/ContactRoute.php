<?php
namespace lmarqs\Spa\Middleware\Route\Api;

use lmarqs\Spa\Middleware\Handler;
use lmarqs\Spa\Middleware\Request;
use lmarqs\Spa\Service\ContactService;

class ContactRoute extends Handler
{
    public function __construct()
    {

        $this->add('', function ($request, $response, $next) {
            if ($request->method() != Request::METHOD_GET) {
                $next();
                return;
            }

            $query = $request->query();
            $q = isset($query["q"]) ? $query["q"] : "";

            $service = new ContactService();

            $hits = $service->find($q);

            $response->write(json_encode($hits))->send();

        });

        $this->add('([0-9]+)', function ($request, $response, $next, $matches) {
            if ($request->method() != Request::METHOD_DELETE) {
                $next();
                return;
            }
            print_r($matches);
            ContactService::delete($matches[0]);
            $response->send();

        });

        $this->add('', function ($request, $response, $next) {
            $response->send(400);
        });
    }
}
