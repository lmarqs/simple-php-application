<?php
namespace lmarqs\Spa\Model;

class Admin implements Authenticable
{
    public function getUsername()
    {
        return getenv('ADMIN_USERNAME');
    }
    public function getPassword()
    {
        return hash('sha256', printf(getenv('AUTHENTICABLE_SECRET'), getenv('ADMIN_USERNAME'), getenv('ADMIN_PASSWORD')));
    }
}
