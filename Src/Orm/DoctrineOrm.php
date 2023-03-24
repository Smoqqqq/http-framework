<?php

namespace Smoq\Orm;

use Smoq\Env\Env;
use Doctrine\ORM\ORMSetup;
use Doctrine\ORM\EntityManager;
use Doctrine\DBAL\DriverManager;

class DoctrineOrm
{
    public function getManager()
    {
        $paths = ["Src/Entity"];
        $isDevMode = Env::get("APP_ENV") === "prod" ? false : true;

        // the connection configuration
        $dbParams = [
            'driver'   => 'pdo_mysql',
            'host' => Env::get("DB_HOST"),
            'user'     => Env::get("DB_USER"),
            'password' => Env::get("DB_PASSWORD"),
            'dbname'   => Env::get("DB_NAME"),
        ];

        $config = ORMSetup::createAttributeMetadataConfiguration($paths, $isDevMode);
        $connection = DriverManager::getConnection($dbParams, $config);
        $entityManager = new EntityManager($connection, $config);

        return $entityManager;
    }
}
