<?php

namespace Labs\Lab5\Controller;

use Labs\Lab5\Database\Database;
use PDO;

class ClientController
{
    public function index()
    {
        $database = Database::getInstance();

        return $database->connection->query('SELECT * FROM clients;')->fetchAll(PDO::FETCH_ASSOC);
    }

    public function save($data)
    {
        $database = Database::getInstance();

        return $database->connection->query('SELECT * FROM clients;')->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update($id, $data)
    {
        $database = Database::getInstance();

        return $database->connection->query('SELECT * FROM clients;')->fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete($id)
    {
        $database = Database::getInstance();

        return $database->connection->query("DELETE FROM clients WHERE id = '$id';")->fetch();
    }
}