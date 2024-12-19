<?php

require '../vendor/autoload.php';

?>
<html>
<head>
    <title>Залоги ломбард</title>
    <style>
        .table_component {
            overflow: auto;
            width: 100%;
            place-items: center;
            margin-bottom: 50px;
        }

        .table_component table {
            height: max-content;
            width: 900px;
            table-layout: auto;
            border-collapse: collapse;
            border: 1px none #dededf;
            text-align: center;
        }

        .table_component caption {
            caption-side: top;
            font-size: x-large;
            margin-bottom: 20px;
        }

        .table_component th {
            border: 1px solid #dededf;
            background-color: #eceff1;
            color: #000000;
            padding: 5px;
        }

        .table_component td {
            border: 1px solid #dededf;
            background-color: #ffffff;
            color: #000000;
            padding: 5px;
        }

        .table_component button.delete {
            text-align: left;
            text-decoration: none;
            display: inline-block;
            border: none;
            background-color: red;
            color: black;
            padding: 5px;
            cursor: pointer;
        }

        .table_component button.update {
            text-align: left;
            text-decoration: none;
            display: inline-block;
            border: none;
            background-color: dodgerblue;
            color: black;
            padding: 5px;
            cursor: pointer;
        }

        .table_component button.create {
            place-items: normal;
            position: initial;
            text-decoration: none;
            display: inline-block;
            border: none;
            background-color: green;
            color: black;
            padding: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
<nav>
    <ul>
        <li>
            <a href="index.php">Главная страница</a>
        </li>
        <li>
            <a href="report.php">Отчеты</a>
        </li>
    </ul>
</nav>

