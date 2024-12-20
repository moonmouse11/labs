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

    public function get($id)
    {
        $database = Database::getInstance();

        return $database->connection->query("SELECT * FROM clients WHERE id = '{$id}';")->fetch(PDO::FETCH_ASSOC);
    }

    public function save($data)
    {
        if ($this->validate($data)) {
            $database = Database::getInstance();

            return $database->connection->query(
                "INSERT INTO clients (full_name, phone, passport_number)
                VALUES ('{$data['full_name']}','{$data['phone']}','{$data['passport_number']}');"
            )->fetch();
        }

        return false;
    }

    public function update($id, $data)
    {
        if ($this->validate($data)) {
            $database = Database::getInstance();

            return $database->connection->query(
                "UPDATE clients SET
                   full_name = '{$data['full_name']}',
                   phone = '{$data['phone']}',
                   passport_number = '{$data['passport_number']}'
                WHERE id = '{$id}';"
            )->fetch();
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