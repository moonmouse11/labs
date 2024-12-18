<?php

use Labs\Lab4\Database\Database;

$result = (new Database())->checkCredentials($_POST['username'], $_POST['password']);

if ($result) { ?>
    <p style="color:rgb(50,150,200); font-size:18px;">Соединение с базой данных успешно установлено.</p>
<?php
} else { ?>
    <p style="color:rgba(220,30,100,1);; font-size:18px;">Произошла ошибка подключения к базе данных.</p>
<?php
}