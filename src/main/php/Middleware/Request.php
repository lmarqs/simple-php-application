<?php

namespace lmarqs\Spa\Middleware;

class Request
{

    const METHOD_GET = 'GET';
    const METHOD_POST = 'POST';
    const METHOD_PUT = 'PUT';
    const METHOD_DELETE = 'DELETE';

    public function params()
    {
        return is_array($_POST) ? $_POST : [];
    }

    public function query()
    {
        return is_array($_GET) ? $_GET : [];
    }

    public function path()
    {
        if (isset($_SERVER['PATH_INFO'])) {
            $path = $_SERVER['PATH_INFO'];
        } elseif (isset($_SERVER['SCRIPT_NAME']) && isset($_SERVER['PHP_SELF'])) {
            $path = str_replace($_SERVER['SCRIPT_NAME'], '', $_SERVER['PHP_SELF']);
        } elseif (isset($_SERVER['REQUEST_URI']) && isset($_SERVER['SCRIPT_NAME']) && isset($_SERVER['QUERY_STRING'])) {
            $path = str_replace($_SERVER['SCRIPT_NAME'], '', str_replace('?' . $_SERVER['QUERY_STRING'], '', $_SERVER['REQUEST_URI']));
        } else {
            $path = '';
        }

        return trim($path, '/');
    }

    public function method()
    {
        // print_r($_REQUEST);
        // print_r($_SERVER);
        return $_SERVER['REQUEST_METHOD'];
    }
}
