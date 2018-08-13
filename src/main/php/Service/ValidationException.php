<?php
class ValidationException extends \Exception
{
    private $errors;
    public function __constructor($errors)
    {
        $this->errors = $errors;
    }
}
