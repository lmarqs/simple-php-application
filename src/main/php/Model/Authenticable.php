<?php
namespace lmarqs\Spa\Model;

interface Autenticable
{
    public function getUsername();
    public function getPassword();
}
