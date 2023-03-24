<?php

namespace Smoq\Orm;

use Smoq\Env\Env;
use Doctrine\ORM\ORMSetup;
use Doctrine\ORM\EntityManager;
use Doctrine\DBAL\DriverManager;

class DoctrineDbal
{
    public function getEntityManager()
    {
        $paths = ["Src/Entity"];
        $isDevMode = Env::get("APP_ENV") === "prod" ? false : true;

        // the connection configuration
        $dbParams = [
            'driver'    => 'pdo_mysql',
            'host'      => Env::get("DB_HOST"),
            'user'      => Env::get("DB_USER"),
            'password'  => Env::get("DB_PASSWORD"),
            'dbname'    => Env::get("DB_NAME"),
        ];

        $conn = DriverManager::getConnection($dbParams);

        return $conn;
    }
}
