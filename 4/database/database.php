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
                "mysql:host=0.0.0.0;dbname=lab4;port:3306",
                $this->credentials['connection']['user'],
                $this->credentials['connection']['password']
            );
        } catch(PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }

}