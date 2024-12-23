<?php

const MAIN_XML_FILE = __DIR__ . '/../resources/books.xml';
const TEMP_UPLOAD_FOLDER = __DIR__ . '/../resources/uploads/';

function handleRequest($request)
{


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
