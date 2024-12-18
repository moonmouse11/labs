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
        if ($this->validate($data)) {
            $database = Database::getInstance();

            return $database->connection->query('SELECT * FROM clients;')->fetch();
        }

        return false;
    }

    public function update($id, $data)
    {
        if ($this->validate($data)) {
            $database = Database::getInstance();

            return $database->connection->query('SELECT * FROM clients;')->fetch();
        }

        return false;
    }

    public function delete($id)
    {
        $database = Database::getInstance();

        return $database->connection->query("DELETE FROM clients WHERE id = '$id';")->fetch();
    }

    private function validate($data)
    {
        return true;
    }
}