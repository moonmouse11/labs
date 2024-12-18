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

    public function save($data)
    {
        $database = Database::getInstance();

        return $database->connection->query(
            'SELECT * FROM pledges
            LEFT JOIN lab5.clients c ON c.id = pledges.client_id
            LEFT JOIN lab5.experts e ON e.id = pledges.expert_id'
        )->fetch();
    }

    public function update($id, $data)
    {
        $database = Database::getInstance();

        return $database->connection->query(
            'SELECT * FROM pledges
            LEFT JOIN lab5.clients c ON c.id = pledges.client_id
            LEFT JOIN lab5.experts e ON e.id = pledges.expert_id'
        )->fetch();
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