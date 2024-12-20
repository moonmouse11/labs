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
            'SELECT pledges.*, client.full_name AS client_full_name, expert.full_name AS expert_full_name FROM pledges
            LEFT JOIN lab5.clients AS client ON client.id = pledges.client_id
            LEFT JOIN lab5.experts AS expert ON expert.id = pledges.expert_id'
        )->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get($id)
    {
        $database = Database::getInstance();

        return $database->connection->query(
            "SELECT pledges.*, client.full_name AS client_full_name, expert.full_name AS expert_full_name FROM pledges
            LEFT JOIN lab5.clients AS client ON client.id = pledges.client_id
            LEFT JOIN lab5.experts AS expert ON expert.id = pledges.expert_id
            WHERE pledges.id = '{$id}';"
        )->fetch(PDO::FETCH_ASSOC);
    }

    public function save($data)
    {
        $database = Database::getInstance();

        $statement = $database->connection->prepare(
            "INSERT INTO pledges (name, price, start_date, over_date, client_id, expert_id)
                VALUES  (:name, :price, :start_date, :over_date, :client_id, :expert_id)"
        );

        return $statement->execute([
            ':name' => $data['name'],
            ':price' => $data['price'],
            ':start_date' => $data['start_date'],
            ':over_date' => empty($data['over_date']) ? null : $data['over_date'],
            ':client_id' => $data['client_id'],
            ':expert_id' => $data['expert_id']
        ]);
    }

    public function update($id, $data)
    {
        $database = Database::getInstance();

        $statement = $database->connection->prepare(
             "UPDATE pledges SET
                   name = :name,
                   price = :price,
                   start_date = :start_date,
                   over_date = :over_date,
                   client_id = :client_id,
                   expert_id = :expert_id
                WHERE id = :id;"
        );

        return $statement->execute([
            ':name' => $data['name'],
            ':price' => $data['price'],
            ':start_date' => $data['start_date'],
            ':over_date' => empty($data['over_date']) ? null : $data['over_date'],
            ':client_id' => $data['client_id'],
            ':expert_id' => $data['expert_id'],
            ':id' => $id,
        ]);
    }

    public function delete($id)
    {
        $database = Database::getInstance();

        return $database->connection->query("DELETE FROM pledges WHERE id = '{$id}';")->fetch();
    }

}