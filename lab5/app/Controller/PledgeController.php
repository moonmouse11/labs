<?php

namespace Labs\Lab5\Controller;

use Labs\Lab5\Database\Database;
use PDO;

class PledgeController
{
    public function index()
    {
        $database = Database::getInstance();

        return $database->connection->query(
            'SELECT * FROM pledges
            LEFT JOIN lab5.clients c ON c.id = pledges.client_id
            LEFT JOIN lab5.experts e ON e.id = pledges.expert_id'
        )->fetchAll(PDO::FETCH_ASSOC);
    }

    public function save($data)
    {

    }

    public function update($id, $data)
    {

    }

    public function delete($id)
    {
        $database = Database::getInstance();

        return $database->connection->query("DELETE FROM pleges WHERE id = '$id';")->fetch();
    }
}