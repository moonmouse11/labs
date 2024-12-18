<?php

namespace Labs\Lab5\Database;

use Labs\Lab5\Config\DatabaseConfig;
use PDO;
use PDOException;

class Database
{
    public $connection = null;

    public function __construct()
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
}