<?php

$database = new Database();

$resource = fopen('csv/tents.csv', 'rb', true);

while (!feof($resource)) {
//    print_r(fgetcsv($resource, null, '|', '#', '#'));
}
//$import = fgetcsv($resource, null, '|','#','#');

