<?php

class Database
{
    public $connection = null;
    private $credentials = [];

    public function __construct()
    {
        $this->credentials = require_once ROOT_PATH . '/config/database.php';

        try {
            $this->connection = new PDO(
                "mysql:host={$this->credentials['connection']['host']};dbname={$this->credentials['connection']['dbname']};port={$this->credentials['connection']['port']}",
                $this->credentials['connection']['user'],
                $this->credentials['connection']['password']
            );
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        } finally {
            $this->checkTable();
        }
    }

    private function checkTable()
    {
        var_dump($this->connection->query(
            "SELECT *
                 FROM INFORMATION_SCHEMA.TABLES
                 WHERE TABLE_SCHEMA = 'lab4' 
                 AND TABLE_NAME = 'tents';"
        )->fetchAll());
    }
}