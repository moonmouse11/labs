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

    }

    public function update($id, $data)
    {

    }

    public function delete($id)
    {

    }
}