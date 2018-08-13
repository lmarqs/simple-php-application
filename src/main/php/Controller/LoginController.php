<?php
namespace lmarqs\Spa\Controller;

use lmarqs\Spa\Middleware\Request;
use lmarqs\Spa\Model\Admin;

class LoginController extends Controller
{

    public static function processRequest($request, $response)
    {

        if ($request->method() == Request::METHOD_POST) {
            $params = $request->parameters();
            $admin = Admin::getInstance();

            if ($admin->getUsername() == $params["username"] && $admin->comparePassword($params["password"])) {
                session_start();
                $_SESSION["username"] = $params["username"];
                $response->setHeader("Location", "/")->send();
                return;
            }
        }

        self::render('login/form', $request, $response);
    }
}
