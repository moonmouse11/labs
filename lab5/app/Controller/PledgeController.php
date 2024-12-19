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
            'SELECT pledges.*, client.*, expert.full_name AS expert_full_name, expert.phone AS expert_phone FROM pledges
            LEFT JOIN lab5.clients AS client ON client.id = pledges.client_id
            LEFT JOIN lab5.experts AS expert ON expert.id = pledges.expert_id'
        )->fetchAll(PDO::FETCH_ASSOC);
    }

    public function save($data)
    {
        if ($this->validate($data)) {
            $database = Database::getInstance();

            return $database->connection->query(
                "INSERT INTO pledges (name, price, start_date, over_date, client_id, expert_id) 
                VALUES ('{$data['name']}','{$data['price']}','{$data['start_date']}','{$data['over_date']}','{$data['client_id']}','{$data['expert_id']}');"
            );
        }

        return false;
    }

    public function update($id, $data)
    {
        if ($this->validate($data)) {
            $database = Database::getInstance();

            return $database->connection->query(
                "UPDATE pledges SET
                    name = '{$data['name']}',
                    price = '{$data['price']}',
                    start_date = '{$data['start_date']}',
                    over_date = '{$data['over_date']}',
                    client_id = '{$data['client_id']}',
                    expert_id = '{$data['expert_id']}'
                WHERE id = '{$id}';"
            );
        }

        return false;
    }

    public function delete($id)
    {
        $database = Database::getInstance();

        return $database->connection->query("DELETE FROM pleges WHERE id = '$id';")->fetch();
    }

    private function validate($data)
    {
        return true;
    }
}