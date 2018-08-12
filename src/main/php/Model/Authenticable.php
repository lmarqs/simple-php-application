<?php
namespace lmarqs\Spa\Model;

interface Authenticable
{
    public function getUsername();
    public function getPassword();
    public function comparePassword($password);
}
