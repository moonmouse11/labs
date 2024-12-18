<?php

namespace Labs\Lab5\Database;

use Labs\Lab5\Config\DatabaseConfig;
use PDO;
use PDOException;

class Database
{
    private static self $instance;
    public $connection = null;

    private function __construct()
    {
        $credentials = DatabaseConfig::CONNECTION;

        try {
            $this->connection = new PDO(
                "mysql:host={$credentials['host']};dbname={$credentials['dbname']};port={$credentials['port']}",
                $credentials['user'],
                $credentials['password']
            );
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }

    private function __clone(){}

    public static function getInstance()
    {
        return self::$instance ?? (self::$instance = new self());
    }
}