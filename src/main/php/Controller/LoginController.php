<?php
namespace lmarqs\Spa\Controller;

class LoginController extends Controller
{

    public static function processRequest($request, $response)
    {
        self::render('login/index', $request, $response);
    }
}
