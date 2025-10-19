<?php
// config/config.php

require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;

// Carregando as váriáveis do arquivo .env
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

// Pega as variáveis do ambiente do Dotenv diretamente
$env = $_ENV;

return [
    'db_credentials' => [
        'host' => $env['DB_HOST'],
        'dbname' => $env['DB_NAME'],
        'user' => $env['DB_USER'],
        'pass' => $env['DB_PASS'],
        'charset' => $env['DB_CHARSET'],
    ],
    'jwt_secret_key' => $env['JWT_SECRET_KEY'],
];
?>