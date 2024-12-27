<?php

const MAIN_XML_FILE = __DIR__ . '/../resources/students.xml';
const TEMP_UPLOAD_FOLDER = __DIR__ . '/../resources/uploads/';

function handleRequest($request)
{
    if (array_key_exists('delete_attribute', $request)) {
        deleteAttribute($request['attribute_name'], $request['delete_attribute']);
    }
    if (array_key_exists('update_attribute', $request)) {
        updateAttribute($request, $request['attribute_name_old'], $request['update_attribute']);
    }
    if (array_key_exists('create_attribute', $request)) {
        createAttribute($request, $request['record_id']);
    }
    if (array_key_exists('delete_element', $request)) {
        deleteElement($request['element_name'], $request['delete_element']);
    }
    if (array_key_exists('update_element', $request)) {
        updateElement($request['element_name_old'], $request, $request['update_element']);
    }
    if (array_key_exists('create_element', $request)) {
        createElement($request, $request['record_id']);
    }
}

function checkXMLFile()
{
    $domDocument = new DOMDocument('1.0', 'UTF-8');

    if (!empty($_FILES['fileToUpload']['tmp_name'])) {
        /* Подгрузка пользовательского XML */
        copy($_FILES['fileToUpload']['tmp_name'], TEMP_UPLOAD_FOLDER . $_FILES['fileToUpload']['name']);
        $domDocument->load($_FILES['fileToUpload']['tmp_name']);
    } elseif (checkTempFiles()) {
        /* Подгрузка ранее загруженного пользовательского XML */
        $domDocument->load(getLatestUploadedFile());
    } else {
        /* Подгрузка исходного XML */
        copy(MAIN_XML_FILE, TEMP_UPLOAD_FOLDER . 'default.xml');
        $domDocument->load(MAIN_XML_FILE);
    }

    return $domDocument;
}

function checkTempFiles()
{
    $files = scandir(TEMP_UPLOAD_FOLDER, SCANDIR_SORT_DESCENDING);

    foreach ($files as $file) {
        if ($file === '.' || $file === '..' || $file === '.gitignore') {
            continue;
        }
        return true;
    }

    return false;
}

function getLatestUploadedFile()
{
    $files = scandir(TEMP_UPLOAD_FOLDER, SCANDIR_SORT_DESCENDING);

    $tempFile = '';
    $fileTimeMax = 0;

    foreach ($files as $file) {
        if ($file === '.' || $file === '..') {
            continue;
        }
        if ($fileTimeMax < filemtime(TEMP_UPLOAD_FOLDER . $file)) {
            $tempFile = TEMP_UPLOAD_FOLDER . $file;
            $fileTimeMax = filemtime(TEMP_UPLOAD_FOLDER . $file);
        }
    }

    return $tempFile;
}

function createElement($element, $recordId)
{
    $domDocument = checkXMLFile();

    $studentNode = $domDocument->getElementsByTagName('student')->item($recordId);


    $newNode = $domDocument->createElement($element['element_name']);
    $newTextNode = $domDocument->createTextNode($element['element_value']);

    $newNode->appendChild($newTextNode);
    $studentNode->appendChild($newNode);

    $domDocument->save(getLatestUploadedFile());
}

function updateElement($oldElement, $newElement, $recordId)
{
    $domDocument = checkXMLFile();

    $studentNode = $domDocument->getElementsByTagName('student')->item($recordId);

    $studentNode->removeChild($studentNode->getElementsByTagName($oldElement)->item(0));

    $newNode = $domDocument->createElement($newElement['element_name']);
    $newTextNode = $domDocument->createTextNode($newElement['element_value']);

    $newNode->appendChild($newTextNode);
    $studentNode->appendChild($newNode);

    $domDocument->save(getLatestUploadedFile());
}

function deleteElement($elementName, $recordId)
{
    $domDocument = checkXMLFile();

    $deletedElement = $domDocument->getElementsByTagName('student')->item($recordId);

    $deletedElement->removeChild($deletedElement->getElementsByTagName($elementName)->item(0));

    $domDocument->save(getLatestUploadedFile());
}

function createAttribute($attribute, $recordId)
{
    $domDocument = checkXMLFile();

    $product = $domDocument->getElementsByTagName('student')->item($recordId);

    $product->setAttribute($attribute['attribute_name'], $attribute['attribute_value']);

    $domDocument->save(getLatestUploadedFile());
}

function updateAttribute($newAttribute, $oldAttribute, $recordId)
{
    $domDocument = checkXMLFile();

    $product = $domDocument->getElementsByTagName('student')->item($recordId);

    $product->removeAttribute($oldAttribute);

    $product->setAttribute($newAttribute['attribute_name'], $newAttribute['attribute_value']);

    $domDocument->save(getLatestUploadedFile());
}

function deleteAttribute($attributeTitle, $recordId)
{
    $domDocument = checkXMLFile();

    $product = $domDocument->getElementsByTagName('student')->item($recordId);

    $product->removeAttribute($attributeTitle);

    $domDocument->save(getLatestUploadedFile());
}

function serachElement($search)
{
    $result = [];

    $domDocument = checkXMLFile();

    $count = $domDocument->getElementsByTagName('student')->count();

    for ($item = 0; $item < $count; $item++) {
        $students = $domDocument->getElementsByTagName('student')->item($item)->childNodes;
        foreach ($students as $student) {
            if (str_contains(mb_strtoupper($student->nodeValue), mb_strtoupper($search))) {
                $result[$item] = $domDocument->getElementsByTagName('student')->item($item);
            }
        }
    }

    return $result;
}