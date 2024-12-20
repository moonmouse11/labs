<?php

require '../vendor/autoload.php';

?>
<html>
<head>
    <title>Залоги ломбард</title>
    <style>
        nav {
            text-align: center;
        }

        nav ul {
            position: relative;
            list-style: none;
            margin: 0;
            padding: 0;
            display: inline-flex;
        }

        nav li {
            margin-right: 20px;
        }

        nav a {
            text-align: center;
            color: #000;
            text-decoration: none;
        }

        .table_component {
            overflow: auto;
            width: 80%;
            place-items: center;
            margin-bottom: 50px;
            margin-left: auto;
            margin-right: auto;
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

        #Client, #Expert {
            position: unset;
            list-style: none;
            width: 30%;
            padding: 12px 20px 12px 40px;
            border: 1px solid #ddd;
            margin-bottom: 12px;
            margin-left: auto;
            margin-right: auto;
            display: block;
        }

        #Pledges, #Clients, #Experts {
            border-collapse: collapse; /* Свернуть границы */
            width: 100%; /* Полная ширина */
            /*border: 1px solid #ddd; !* Добавить серую границу *!*/
            font-size: 18px; /* Увеличить размер шрифта */
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
<hr>

