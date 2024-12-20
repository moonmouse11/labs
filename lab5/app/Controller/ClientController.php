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
        $database = Database::getInstance();

        $statement = $database->connection->prepare(
            "INSERT INTO clients (full_name, phone, passport_number)
                VALUES  (:full_name, :phone, :passport_number);"
        );

        return $statement->execute([
            ':full_name' => $data['full_name'],
            ':phone' => $data['phone'],
            ':passport_number' => $data['passport_number'],
        ]);
    }

    public function update($id, $data)
    {
        $database = Database::getInstance();

        $statement = $database->connection->prepare(
            "UPDATE clients SET
                   full_name = :full_name,
                   phone = :phone,
                   passport_number = :passport_number
                WHERE id = :id;"
        );

        return $statement->execute([
            ':full_name' => $data['full_name'],
            ':phone' => $data['phone'],
            ':passport_number' => $data['passport_number'],
            ':id' => $id
        ]);
    }

    public function delete($id)
    {
        $database = Database::getInstance();

        return $database->connection->query("DELETE FROM clients WHERE id = '$id';")->fetch();
    }

}