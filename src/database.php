<?php
// src/Database.php

class Database {
    private static $instance = null;
    private $pdo;

    private function __construct(array $config) {
        $dsn = "mysql:host={$config['host']};dbname={$config['dbname']};charset={$config['charset']}";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        $this->pdo = new PDO($dsn, $config['user'], $config['pass'], $options);
    }

    public static function getInstance() {
        if (self::$instance === null) {
            $config = require __DIR__ . '/../config/config.php';
            self::$instance = new Database($config['db_credentials']);
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->pdo;
    }
}