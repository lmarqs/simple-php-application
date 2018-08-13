<?php
namespace lmarqs\Spa\Persistence;

class ConnectionFactory
{
    private static $pdo;

    public function connection()
    {
        if (!self::$pdo) {
            self::$pdo = new \PDO(getenv('PDO_DNS'), getenv('PDO_USERNAME'), getenv('PDO_PASSWORD'));
        }
        return self::$pdo;
    }

}
