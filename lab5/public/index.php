<?php

use Labs\Lab5\Controller\MainController;

require '../vendor/autoload.php';

echo '<pre>';
var_dump((new \Labs\Lab5\Controller\ExpertController())->index());
echo '</pre>';
?>

