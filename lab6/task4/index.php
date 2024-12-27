<?php

require 'functions/functions.php';

handleRequest($_POST);

$domDocument = checkXMLFile();
?>

<!DOCTYPE html>
<html lang="ru/RU">
<head>
    <title>XML task 4</title>
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
    <h2>Список студентов</h2>
</div>
<div>
    <?php
    $count = $domDocument->getElementsByTagName('student')->count();
    for ($item = 0; $item < $count; $item++) :
        $student = $domDocument->getElementsByTagName('student')->item($item); ?>
        <h4>Студент №<?= $item + 1 ?></h4>
        <table>
            <caption>Атрибуты</caption>
            <?php
            foreach ($student->attributes as $attribute) :
                $title = $attribute->nodeName;
                $name = $attribute->nodeValue; ?>
                <tr>
                    <form action="/" method="POST" id="update_attribute_<?= $item . '_' . $title ?>">
                        <td><input type="text" id="<?= $title ?>" required name="attribute_name" value="<?= $title ?>"></td>
                        <td><input type="text" id="<?= $name ?>" required name="attribute_value" value="<?= $name ?>"></td>
                        <input type="hidden" name="attribute_name_old" value="<?= $title ?>">
                    </form>
                    <form action="/" method="POST" id="delete_attribute_<?= $item . '_' . $title ?>">
                        <input type="hidden" name="attribute_name" value="<?= $title ?>"></form>
                    <td style="border: none; text-align: left">
                        <button form="update_attribute_<?= $item . '_' . $title ?>" name="update_attribute" value="<?= $item ?>">Изменить</button>
                        <button form="delete_attribute_<?= $item . '_' . $title ?>" name="delete_attribute" value="<?= $item ?>">Удалить</button>
                    </td>
                </tr>
            <?php
            endforeach; ?>
            <tr>
                <form action="/" method="POST" id="create_attribute_<?= $item ?>">
                    <td><input type="text" id="attribute_name" required name="attribute_name" value=""></td>
                    <td><input type="text" id="attribute_value" required name="attribute_value" value=""></td>
                    <input type="hidden" name="record_id" value="<?= $item ?>">
                    <td><input type="submit" name="create_attribute" value="Добавить"></td>
                </form>
            </tr>
        </table>
        <table>
            <caption>Элементы</caption>
            <?php
            foreach ($student->childNodes as $name) :
                if ($name->nodeName !== '#text') :
                    $title = $name->nodeName;
                    $name = $name->nodeValue;
                    ?>
                    <tr>
                        <form action="/" method="POST" id="update_element_<?= $item . '_' . $title ?>">
                            <td><input type="text" id="<?= $title ?>" required name="element_name" value="<?= $title ?>"></td>
                            <td><input type="text" id="<?= $name ?>" required name="element_value" value="<?= $name ?>"></td>
                            <input type="hidden" name="element_name_old" value="<?= $title ?>">
                        </form>
                        <form action="/" method="POST" id="delete_element_<?= $item . '_' . $title ?>">
                            <input type="hidden" name="element_name" value="<?= $title ?>"></form>
                        <td style="border: none; text-align: left">
                            <button form="update_element_<?= $item . '_' . $title ?>" name="update_element" value="<?= $item ?>">Изменить</button>
                            <button form="delete_element_<?= $item . '_' . $title ?>" name="delete_element" value="<?= $item ?>">Удалить</button>
                        </td>
                    </tr>
                <?php
                endif; ?>
            <?php
            endforeach; ?>
            <tr>
                <form action="/" method="POST" id="create_element_<?= $item ?>">
                    <td><input type="text" id="element_name" required name="element_name" value=""></td>
                    <td><input type="text" id="element_value" required name="element_value" value=""></td>
                    <input type="hidden" name="record_id" value="<?= $item ?>">
                    <td><input type="submit" name="create_element" value="Добавить"></td>
                </form>
            </tr>
        </table>
    <?php
    endfor; ?>
</div>
</body>
</html>