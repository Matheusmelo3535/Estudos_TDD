<?php

namespace Estudos_TDD\Infra;
use PDO;

class ConnectionCreator
{
    public static function createConnection(): PDO
    {
        $connection = new PDO(
            'mysql:host=localhost;dbname=rankings',
            'root',
            ''
        );
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $connection;
    }
}

?>