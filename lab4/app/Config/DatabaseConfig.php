<?php

namespace Labs\Lab4\Config;

class DatabaseConfig
{
    public const CONNECTION = [
        'host' => '0.0.0.0',
        'port' => 3306,
        'dbname' => 'lab4',
        'charset' => 'utf8mb4',
        'user' => 'root',
        'password' => 'strong_password'
    ];
}