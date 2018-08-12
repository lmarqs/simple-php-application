<?php
namespace lmarqs\Spa\Model;

use lmarqs\Spa\Core\SingletonTrait;

class Admin implements Authenticable
{
    use SingletonTrait;

    public function getUsername()
    {
        return getenv('ADMIN_USERNAME');
    }

    public function getPassword()
    {
        return $this->encriptPassword(getenv('ADMIN_PASSWORD'));
    }

    public function comparePassword($password)
    {
        return $this->getPassword() == $this->encriptPassword($password);
    }

    private function encriptPassword($password)
    {
        return hash('sha256', sprintf(getenv('AUTHENTICABLE_SECRET'), getenv('ADMIN_USERNAME'), $password));
    }
}
