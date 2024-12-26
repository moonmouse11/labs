<?php

const MAIN_XML_FILE = __DIR__ . '/../resources/products.xml';
const TEMP_UPLOAD_FOLDER = __DIR__ . '/../resources/uploads/';

function handleRequest($request)
{
    var_dump($request);
}

function checkXMLFile()
{
    if (!empty($_FILES['fileToUpload']['tmp_name'])) {
        /* Подгрузка пользовательского XML */
        copy($_FILES['fileToUpload']['tmp_name'], TEMP_UPLOAD_FOLDER . $_FILES['fileToUpload']['name']);
        $products = simplexml_load_file($_FILES['fileToUpload']['tmp_name'], 'SimpleXMLElement');
    } elseif (checkTempFiles()) {
        /* Подгрузка ранее загруженного пользовательского XML */
        $products = simplexml_load_file(getLatestUploadedFile(), 'SimpleXMLElement');
    } else {
        /* Подгрузка исходного XML */
        copy(MAIN_XML_FILE, TEMP_UPLOAD_FOLDER . 'default.xml');
        $products = simplexml_load_file(MAIN_XML_FILE, 'SimpleXMLElement');
    }

    return $products;
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

function createRecord($record)
{
    $domDocument = checkXMLFile();

    $bookNode = $domDocument->createElement('book');

    foreach ($record as $title => $value){
        if ($title === 'create_record') {
            continue;
        }
        $titleNode = $domDocument->createElement($title);
        $valueNode = $domDocument->createTextNode($value);
        $titleNode->appendChild($valueNode);
        $bookNode->appendChild($titleNode);
    }

    $domDocument->documentElement->appendChild($bookNode);

    $domDocument->save(getLatestUploadedFile());

}

function updateRecord($recordId, $record)
{
    $domDocument = checkXMLFile();

    $bookNode = $domDocument->getElementsByTagName('book')->item($recordId - 1);

    foreach ($record as $title => $value){
        if ($title === 'update_record') {
            continue;
        }
        $bookNode->getElementsByTagName($title)->item(0)->nodeValue = $value;
    }

    $domDocument->save(getLatestUploadedFile());
}

function deleteRecord($recordId)
{
    $domDocument = checkXMLFile();

    $deletedElement = $domDocument->getElementsByTagName('book')->item($recordId - 1);

    $deletedElement->remove();

    $domDocument->save(getLatestUploadedFile());
}
