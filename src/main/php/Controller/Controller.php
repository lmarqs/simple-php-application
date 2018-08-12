<?php

namespace lmarqs\Spa\Controller;

abstract class Controller
{
    const MAIN_VIEW = 'main.tpl.php';
    const VIEW_PATH = 'view';

    abstract public static function processRequest($request, $response);

    protected function render($view, $request, $response)
    {
        $BUNDLES_SERVER_ADDRESS = getenv('CONTROLLER_BUNDLES_SERVER_ADDRESS');

        $attrs = $request->attributes();
        $params = $request->parameters();
        $query = $request->query();
        $errors = $request->errors();
        $classes = $request->classes();

        ob_start();
        include implode(DIRECTORY_SEPARATOR, [Controller::VIEW_PATH, "$view.tpl.php"]);
        $content = ob_get_clean();

        ob_start();
        include implode(DIRECTORY_SEPARATOR, [Controller::VIEW_PATH, Controller::MAIN_VIEW]);
        $response->write(ob_get_clean())->send(200);

    }
}
