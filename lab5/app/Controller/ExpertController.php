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
        if($this->validate($data)) {
            $database = Database::getInstance();

            return $database->connection->query(
                "INSERT INTO experts (full_name, phone, hiring_date)
                VALUES ('{$data['full_name']}','{$data['phone']}','{$data['hiring_date']}');"
            )->fetch();
        }

        return false;
    }

    public function update($id, $data)
    {
        if ($this->validate($data)) {
            $database = Database::getInstance();

            return $database->connection->query(
                "UPDATE experts SET
                   full_name = '{$data['full_name']}',
                   phone = '{$data['phone']}',
                   hiring_date = '{$data['hiring_date']}'
                WHERE id = '{$id}';"
            )->fetch();
        }

        return false;
    }

    public function delete($id)
    {
        $database = Database::getInstance();

        return $database->connection->query(
            "DELETE FROM experts WHERE id = '$id';"
        )->fetch();
    }

    private function validate($data)
    {
        return true;
    }
}