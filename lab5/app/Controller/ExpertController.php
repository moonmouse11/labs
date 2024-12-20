<?php

namespace Labs\Lab5\Controller;

use Labs\Lab5\Database\Database;
use PDO;

class ExpertController
{
    public function index()
    {
        $database = Database::getInstance();

        return $database->connection->query(
            'SELECT * FROM experts LEFT JOIN lab5.types_experts te on experts.id = te.expert_id'
        )->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get($id)
    {
        $database = Database::getInstance();

        return $database->connection->query(
            "SELECT * FROM experts LEFT JOIN lab5.types_experts te on experts.id = te.expert_id WHERE experts.id = '{$id}'"
        )->fetch(PDO::FETCH_ASSOC);
    }


    public function save($data)
    {
        $database = Database::getInstance();

        $statement = $database->connection->prepare(
            "INSERT INTO experts (full_name, phone, hiring_date)
                VALUES  (:full_name, :phone, :hiring_date);"
        );

        return $statement->execute([
            ':full_name' => $data['full_name'],
            ':phone' => $data['phone'],
            ':hiring_date' => $data['hiring_date'],
        ]);
    }

    public function update($id, $data)
    {
        $database = Database::getInstance();

        $statement = $database->connection->prepare(
            "UPDATE experts SET
                   full_name = :full_name,
                   phone = :phone,
                   hiring_date = :hiring_date
                WHERE id = :id;"
        );

        return $statement->execute([
            ':full_name' => $data['full_name'],
            ':phone' => $data['phone'],
            ':hiring_date' => $data['hiring_date'],
            ':id' => $id
        ]);
    }

    public function delete($id)
    {
        $database = Database::getInstance();

        return $database->connection->query(
            "DELETE FROM experts WHERE id = '$id';"
        )->fetch();
    }

}