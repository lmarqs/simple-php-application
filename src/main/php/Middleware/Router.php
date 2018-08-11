<?php

namespace lmarqs\Spa\Middleware;

use lmarqs\Spa\Core\Logger;

class Router
{

    public function run($request, $response, $root, $basepath = '')
    {

        foreach ($root->handlers as $handler) {

            $path = $basepath . $handler['path'];

            if (preg_match('/^' . str_replace('/', '\/', trim($path, '\/')) . '/', trim($request->path(), '\/'))) {

                $continue = false;

                $next = function ($ex = '') use (&$continue) {
                    if ($ex) {
                        Logger::getInstance()->e('ROUTER', $ex->getMessage() . "\n" . $ex->getTraceAsString());
                        return;
                    }

                    $continue = true;
                };

                try {
                    if ($handler['callable'] instanceof Handler) {

                        $this->run($request, $response, $handler['callable'], $path . '/');

                    } else {

                        preg_match('/' . str_replace('/', '\/', $handler['path']) . '/', $request->path(), $matches);

                        array_shift($matches); // Remove the first element that contains the whole string

                        $handler['callable']($request, $response, $next, $matches);
                    }
                } catch (\Exception $ex) {
                    $next($ex);
                }

                if (!$continue) {
                    break;
                }
            }

        }

    }

}
