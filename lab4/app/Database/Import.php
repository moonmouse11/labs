<?php

namespace Labs\Lab4\Database;

class Import
{
    private $database = null;
    private $csvResource = null;
    private const CSV_FILE_PATH = __DIR__ . '/csv/tents.csv';

    public function __construct()
    {
        $this->database = new Database();
        $this->csvResource = fopen(self::CSV_FILE_PATH, 'rb', true);
    }

    public function importData()
    {
        $values = '';

        while ($line = stream_get_line($this->csvResource, 4096, '#')) {
            $row = str_getcsv($line, '|');
            if (!empty($row[0])) {
                $values .= "('$row[0]', '$row[1]', '$row[2]', $row[3], '$row[4]', '$row[5]'), ";
            }
        }

        $values = rtrim($values, ', ');

        $this->database->connection->query(
            "INSERT INTO tents (title, brand, category, places, description, picture)
            VALUES {$values};"
        );
    }

}

