<?php
namespace lmarqs\Spa\Controller;

class IndexController extends Controller
{

    public static function processRequest($request, $response)
    {
        self::render('index', $request, $response);
    }
}
