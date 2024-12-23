<?php

require 'functions/functions.php';

$books = checkXMLFile();

//var_dump($books->getElementsByTagName('title')->getIterator()->current()->nodeValue);

var_dump($books);

?>

<!DOCTYPE html>
<html lang="ru/RU">
<head>
    <title>XML task 2</title>
</head>
<body
<div>
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
<!--            --><?php //foreach ($books->attributes() as $key => $value) : ?>
<!--            <th>--><?php //= $key ?><!--</th>-->
<!--            --><?php //endforeach; ?>
        </tr>
        <?php
        foreach ($books->children() as $movie) : ?>
            <form action="/" method="POST" id="update_record_<?= $index ?>">
            <td><input type="text" id="title" required name="title" value="<?= $movie->title ?>"></td>
            <td><input type="text" id="director" required name="director" value="<?= $movie->director ?>"></td>
            <td><input type="number" id="year" required name="year" value="<?= $movie->year ?>"></td>
            <td><input type="text" id="genre" required name="genre" value="<?= $movie->genre ?>"></td>
            </form>
            <form action="/" method="POST" id="delete_record""></form>
            <td style="border: none; text-align: left">
                <button class="update" form="update_record_<?= $index ?>" name="update_xml_record" value="<?= $movie->asXML() ?>">
                    Редактировать
                </button>
                <button class="delete" form="delete_record" name="delete_xml_record" value="<?= $movie->asXML() ?>">
                    Удалить
                </button>
            </td>
            </tr>
        <?php
        $index++;
        endforeach; ?>
    </table>
</div>
</body>
</html>