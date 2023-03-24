<?php

require 'vendor/autoload.php';

use Smoq\Env\Env;
use Dotenv\Dotenv;
use Doctrine\ORM\ORMSetup;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Doctrine\DBAL\DriverManager;
use Smoq\Env\DefaultEnvironment;
use Doctrine\Migrations\DependencyFactory;
use Doctrine\Migrations\Configuration\Migration\PhpFile;
use Doctrine\Migrations\Configuration\EntityManager\ExistingEntityManager;

$config = new PhpFile('migrations.php'); // Or use one of the Doctrine\Migrations\Configuration\Configuration\* loaders

$dotenv = Dotenv::createImmutable(getcwd());

DefaultEnvironment::setDefaults();
Env::addVariables($dotenv->load());

$paths = [getcwd() . DIRECTORY_SEPARATOR . "App" . DIRECTORY_SEPARATOR . "Entity"];
$isDevMode = Env::get("APP_ENV") === "prod" ? false : true;

// the connection configuration
$dbParams = [
    'driver'   => 'pdo_mysql',
    'host' => Env::get("DB_HOST"),
    'user'     => Env::get("DB_USER"),
    'password' => Env::get("DB_PASSWORD"),
    'dbname'   => Env::get("DB_NAME"),
];

$connection = DriverManager::getConnection($dbParams);
$config = ORMSetup::createAttributeMetadataConfiguration($paths, $isDevMode);
$entityManager = new EntityManager($connection, $config);

$config = new PhpFile("config/migrations.php");
return DependencyFactory::fromEntityManager($config, new ExistingEntityManager($entityManager));