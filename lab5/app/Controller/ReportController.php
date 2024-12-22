<?php

namespace Labs\Lab5\Controller;

use Labs\Lab5\Database\Database;
use PDO;

class ReportController
{
    private $database;

    public function __construct()
    {
        $this->database = Database::getInstance();
    }

    public function getAverage()
    {
        return $this->database->connection->query(
            "SELECT client.full_name AS client_full_name, client_id, AVG(price) AS average FROM pledges
                LEFT JOIN lab5.clients AS client ON client.id = pledges.client_id
                GROUP BY client_id"
        )->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getStorageItems()
    {
        return $this->database->connection->query(
            "SELECT DATEDIFF(CURRENT_DATE, start_date) AS days_in_storage, name
                FROM pledges"
        )->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPledgesTimes()
    {
        return $this->database->connection->query(
            "SELECT DATE_FORMAT(start_date, '%Y-%m') AS period, COUNT(*) AS num_pledges
                FROM pledges GROUP BY period ORDER BY period"
        )->fetchAll(PDO::FETCH_ASSOC);
    }
}