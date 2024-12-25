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
    <form action="/" method="post" enctype="multipart/form-data">
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
                <form action="/" method="POST" id="delete_record"></form>
                    <td style="border: none; text-align: left">
                        <button class="update" form="update_record_<?= $index ?>" name="update_xml_record" value="">Редактировать</button>
                        <button class="delete" form="delete_record" name="delete_xml_record" value="<?= $index ?>">Удалить</button>
                    </td>
                    <?php $index++; endif; ?>
            </tr>
        <?php endforeach; ?>
            <form action="form.php" method="POST" id="create_record"></form>
            <td style="border: none; text-align: left">
                <button class="create" form="create_record" name="create_record">Добавить</button>
            </td>
    </table>
</div>
</body>
</html>