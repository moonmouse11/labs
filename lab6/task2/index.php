<?php

require 'functions/functions.php';

handleRequest($_POST);

$booksDOM = checkXMLFile();

$elementsArray = [];
$index = 1;
?>

<!DOCTYPE html>
<html lang="ru/RU">
<head>
    <title>XML task 2</title>
</head>
<body>
<div style="margin-bottom: 40px">
    <form action="/" method="POST" enctype="multipart/form-data">
        Select XML to upload:
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="Upload XML" name="submit">
    </form>
</div>
<div>
    <table>
        <caption>Список книг</caption>
        <tr class="header">
            <?php
            foreach ($booksDOM->getElementsByTagName('book')->item(0)->childNodes as $name) :
                if ($name->nodeName !== '#text') :
                    $elementsArray[] = $name->nodeName; ?>
                    <th><?= $name->nodeName ?></th>
                <?php
                endif; ?>
            <?php
            endforeach; ?>
        </tr>
        <?php
        foreach ($booksDOM->documentElement->childNodes as $book) : ?>
            <tr>
                <form action="/" method="POST" id="update_record_<?= $index ?>">
                    <?php
                    if ($book->nodeName !== '#text') : ?>
                        <?php foreach ($elementsArray as $element) : ?>
                            <td><input type="text" id="<?= $element ?>" required name="<?= $element ?>" value="<?= $book->getElementsByTagName($element)->item(0)->nodeValue ?>"></td>
                        <?php endforeach; ?>
                </form>
                <form action="/" method="POST" id="delete_record_<?= $index ?>"></form>
                    <td style="border: none; text-align: left">
                        <button form="update_record_<?= $index ?>" name="update_record" value="<?= $index ?>">Редактировать</button>
                        <button form="delete_record_<?= $index ?>" name="delete_record" value="<?= $index ?>">Удалить</button>
                    </td>
                    <?php $index++; endif; ?>
            </tr>
        <?php endforeach; ?>
            <tr>
                <form action="/" method="POST" id="create_record">
                <?php foreach ($elementsArray as $element) : ?>
                    <td><input type="text" id="<?= $element ?>" required name="<?= $element ?>" value=""></td>
                <?php endforeach; ?>
                    <input type="hidden" name="create_record">
                <td><input type="submit" name="create_record" value="Добавить"></td>
                </form>
            </tr>
    </table>
</div>
</body>
</html>