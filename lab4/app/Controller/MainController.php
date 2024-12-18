<?php

namespace Labs\Lab4\Controller;

use Labs\Lab4\Database\Database;

class MainController
{
    public static function index()
    {
        self::view('index');

        self::checkPost();
        self::checkGet();
    }

    private static function view($name)
    {
        require_once __DIR__ . '/../View/' . $name . '.view.php';
    }

    private static function checkPost()
    {
        if (isset($_POST['username'], $_POST['password'])) {
            self::view('auth');
        }
    }

    private static function checkGet()
    {
        if (isset($_GET['brand'])) {
            self::view('brand');
        }

        if (isset($_GET['number'])) {
            self::view('number');
        }
    }
}