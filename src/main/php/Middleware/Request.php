<?php

namespace lmarqs\Spa\Middleware;

class Request
{

    const METHOD_GET = 'GET';
    const METHOD_POST = 'POST';
    const METHOD_PUT = 'PUT';
    const METHOD_DELETE = 'DELETE';

    private $attributes = [];
    private $errors = [];

    public function addErrors($errors)
    {
        foreach ($errors as $key => $value) {
            $this->errors[$key] = $value;
        }
    }

    public function setAttribute($key, $value)
    {
        return $this->attributes[$key] = $value;
    }

    public function getAttribute($key)
    {
        return isset($this->attributes[$key]) ? $this->attributes[$key] : null;
    }

    public function addAttributes($attributes)
    {
        foreach ($attributes as $key => $value) {
            $this->attributes[$key] = $value;
        }
    }

    public function attributes()
    {
        return $this->attributes;
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
