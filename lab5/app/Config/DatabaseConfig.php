<?php

namespace Labs\Lab5\Config;

class DatabaseConfig
{
    public const CONNECTION = [
        'host' => '0.0.0.0',
        'port' => 3306,
        'dbname' => 'lab5',
        'charset' => 'utf8mb4',
        'user' => 'root',
        'password' => 'strong_password'
    ];
}