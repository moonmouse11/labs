<?php

require 'functions/functions.php';

handleRequest($_POST);

$products = checkXMLFile();

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
    <h2>Список товаров</h2>
</div>
<div>
    <?php
    foreach ($products->children() as $product) : ?>
        <div>
            <table>
                <thead>
                <tr>
                    <td>Attribute Name</td>
                    <td>Attribute Value</td>
                </tr>
                </thead>
                <?php
                foreach ($product->attributes() as $title => $name) : ?>
                    <tr>
                        <form action="/" method="POST" id="update_attribute_<?= $index . '_' . $title ?>">
                            <td><input type="text" id="<?= $title ?>" required name="<?= $title ?>"
                                       value="<?= $title ?>"></td>
                            <td><input type="text" id="<?= $name ?>" required name="<?= $name ?>" value="<?= $name ?>">
                            </td>
                        </form>

                        <form action="/" method="POST" id="delete_attribute_<?= $index . '_' . $title ?>"></form>
                        <td style="border: none; text-align: left">
                            <button form="update_attribute_<?= $index . '_' . $title ?>" name="update_attribute"
                                    value="<?= $index ?>">
                                Изменить
                            </button>
                            <button form="delete_attribute_<?= $index . '_' . $title ?>" name="delete_attribute"
                                    value="<?= $index . '_' . $title ?>">
                                Удалить
                            </button>
                        </td>
                    </tr>
                <?php
                endforeach; ?>

                <tr>
                    <form action="/" method="POST" id="create_attribute_<?= $index ?>">
                        <td><input type="text" id="attribute_name" required name="attribute_name" value=""></td>
                        <td><input type="text" id="attribute_value" required name="attribute_value" value=""></td>
                        <input type="hidden" name="record_id" value="<?= $index ?>">
                        <td><input type="submit" name="create_attribute" value="Добавить"></td>
                    </form>
                </tr>
            </table>
        </div>
        <?php
        $index++;
    endforeach; ?>
</div>
</body>
</html>
