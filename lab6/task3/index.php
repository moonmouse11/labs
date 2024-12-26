<?php

require 'functions/functions.php';

handleRequest($_POST);

$products = checkXMLFile();

var_dump($products);

$attributes = [];
$index = 1;
?>

<!DOCTYPE html>
<html lang="ru/RU">
<head>
    <title>XML task 3</title>
</head>
<body>
<div style="margin-bottom: 40px">
    <form action="/" method="post" enctype="multipart/form-data">
        Select XML to upload:
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="Upload XML" name="submit">
    </form>
</div>
<div>
    <table>
        <thead>
        <caption>Список товаров</caption>
        <tr class="header">
            <?php
            foreach ($products->children() as $product) :
                foreach ($product->attributes() as $title => $name) :
                    $elementsArray[] = $name; ?>
                    <th><?= $title . ' ' . $name ?></th>
                <?php
                endforeach;
            endforeach; ?>
        </tr>
        </thead>
        <tbody>
        <tr>
            <form action="/" method="POST" id="create_attribute">
                <?php
                foreach ($attributes as $attribute) : ?>
                    <td><input type="text" id="<?= $attribute ?>" required name="<?= $attribute ?>" value=""></td>
                <?php
                endforeach; ?>
                <input type="hidden" name="create_attribute">
                <td><input type="submit" name="create_attribute" value="Добавить"></td>
            </form>
        </tr>
        </tbody>
    </table>
</div>
</body>
</html>
