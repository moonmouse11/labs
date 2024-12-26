<?php

const MAIN_XML_FILE = __DIR__ . '/../resources/products.xml';
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

function createAttribute($attribute, $recordId)
{


}

function updateAttribute($attribute, $oldAttrubute, $recordId)
{

}

function deleteAttribute($attributeTitle, $reecordId)
{
    $products = checkXMLFile();

    $record = simplexml_load_string($record);

    $count = 0;

    foreach ($movies->children() as $movie) {
        if (compareXml($movie, $record)) {
            break;
        }

        $count++;
    }
    unset($movies->movie[$count]);

    file_put_contents(getLatestUploadedFile(), $movies->asXML());

}
