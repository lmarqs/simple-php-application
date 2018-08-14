<?php
namespace lmarqs\Spa\Service;

class ValidationException extends \Exception
{
    private $errors;
    public function setErrors($errors)
    {
        $this->errors = $errors;
    }
    public function getErrors()
    {
        return $this->errors;
    }
}
