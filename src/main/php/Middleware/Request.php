<?php

namespace lmarqs\Spa\Middleware;

class Request
{

    const METHOD_GET = 'GET';
    const METHOD_POST = 'POST';
    const METHOD_PUT = 'PUT';
    const METHOD_DELETE = 'DELETE';

    private $attributes = [];
    private $classes = [];
    private $errors = [];

    public function setClass($key, $value)
    {
        return $this->classes[$key] = $value;
    }

    public function getClass($key)
    {
        return $this->classes[$key];
    }

    public function setError($key, $value)
    {
        return $this->errors[$key] = $value;
    }

    public function getError($key)
    {
        return $this->errors[$key];
    }

    public function setAttribute($key, $value)
    {
        return $this->attributes[$key] = $value;
    }

    public function getAttribute($key)
    {
        return $this->attributes[$key];
    }

    public function attributes()
    {
        return $this->attributes;
    }

    public function classes()
    {
        return $this->classes;
    }

    public function errors()
    {
        return $this->errors;
    }

    public function parameters()
    {
        return is_array($_POST) ? $_POST : [];
    }

    public function query()
    {
        return is_array($_GET) ? $_GET : [];
    }

    public function path()
    {
        return trim($_SERVER['REQUEST_URI'], '/');
    }

    public function method()
    {
        return $_SERVER['REQUEST_METHOD'];
    }
}
