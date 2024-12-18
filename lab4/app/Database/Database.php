<?php

namespace Labs\Lab4\Database;

use Labs\Lab4\Config\DatabaseConfig;
use PDO;
use PDOException;

class Database
{
    public $connection = null;
    private $credentials = [];

    public function __construct()
    {
        $this->credentials = DatabaseConfig::CONNECTION;

        try {
            $this->connection = new PDO(
                "mysql:host={$this->credentials['host']};dbname={$this->credentials['dbname']};port={$this->credentials['port']}",
                $this->credentials['user'],
                $this->credentials['password']
            );
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        } finally {
            $this->checkTable();
        }
    }

    private function checkTable()
    {
        $tableResult = $this->connection->query(
            "SELECT *
                 FROM INFORMATION_SCHEMA.TABLES
                 WHERE TABLE_SCHEMA = '{$this->credentials['dbname']}'
                 AND TABLE_NAME = 'tents';"
        )->fetchAll();

        if (empty($tableResult)) {
            $this->connection->query(
                "CREATE TABLE tents (
                    id int PRIMARY KEY AUTO_INCREMENT,
                    title varchar(255) NOT NULL,
                    brand varchar(255) NOT NULL,
                    category varchar(255),
                    places int,
                    description text,
                    picture varchar(255));"
            );
            (new Import())->importData();
        }
    }


}