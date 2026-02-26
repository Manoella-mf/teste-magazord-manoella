<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Doctrine\ORM\ORMSetup;
use Doctrine\ORM\EntityManager;
use Doctrine\DBAL\DriverManager;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$config = ORMSetup::createAttributeMetadataConfiguration(
    paths: [__DIR__ . "/../app/Models"],
    isDevMode: true
);

$config->setMetadataCache(new \Symfony\Component\Cache\Adapter\ArrayAdapter());
$config->setQueryCache(new \Symfony\Component\Cache\Adapter\ArrayAdapter());

$connectionParams = [
    'dbname'   => $_ENV['DB_NAME'],
    'user'     => $_ENV['DB_USER'],
    'password' => $_ENV['DB_PASS'],
    'host'     => $_ENV['DB_HOST'],
    'driver'   => 'pdo_mysql',
];

$connection = DriverManager::getConnection($connectionParams, $config);
$entityManager = new EntityManager($connection, $config);

return $entityManager;