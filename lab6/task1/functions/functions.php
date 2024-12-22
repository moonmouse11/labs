<?php

const MAIN_XML_FILE = __DIR__ . '/../resources/movies.xml';
const TEMP_UPLOAD_FOLDER = __DIR__ . '/../resources/uploads/';

function checkXMLFile()
{
    if (!empty($_FILES['fileToUpload']['tmp_name'])) {
        /* Подгрузка пользовательского XML */
        copy($_FILES['fileToUpload']['tmp_name'], TEMP_UPLOAD_FOLDER . $_FILES['fileToUpload']['name']);
        $movies = simplexml_load_file($_FILES['fileToUpload']['tmp_name'], 'SimpleXMLElement');
    } elseif (checkTempFiles()) {
        /* Подгрузка ранее загруженного пользовательского XML */
        $movies = simplexml_load_file(getLatestUploadedFile(), 'SimpleXMLElement');
    } else {
        /* Подгрузка исходного XML */
        copy(MAIN_XML_FILE, TEMP_UPLOAD_FOLDER . 'default.xml');
        $movies = simplexml_load_file(MAIN_XML_FILE, 'SimpleXMLElement');
    }

    return $movies;
}

function updateXMLRecord($oldRecord, $newRecord)
{
    $count = 0;

    $movies = checkXMLFile();

    $oldRecord = simplexml_load_string($oldRecord);

    foreach ($movies->children() as $movie) {
        if (compareXml($movie, $oldRecord)) {
            break;
        }
        $count++;
    }

    unset($movies->movie[$count]);

    $xml = new SimpleXMLElement('<movie></movie>');

    foreach ($newRecord as $key => $value) {
        if ($key == 'update_xml_record') {
            continue;
        }

        $xml->addChild($key, $value);
    }

    sxml_append($movies, $xml);

    file_put_contents(getLatestUploadedFile(), $movies->asXML());
}

function deleteXMLRecord($record)
{
    $movies = checkXMLFile();

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

function handleRequest($request)
{
    if (array_key_exists('delete_xml_record', $request)) {
        deleteXMLRecord($request['delete_xml_record']);
    }
    if (array_key_exists('update_xml_record', $request)) {
        updateXMLRecord($request['update_xml_record'], $request);
    }
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

function compareXml($xml1, $xml2)
{
    if ($xml1 === $xml2) {
        return true;
    }

    if ($xml1->getName() !== $xml2->getName()) {
        return false;
    }

    $children1 = $xml1->children();
    $children2 = $xml2->children();

    if (count($children1) !== count($children2)) {
        return false;
    }

    foreach ($children1 as $child1) {
        $found = false;
        foreach ($children2 as $child2) {
            if ($child1->getName() === $child2->getName()) {
                if ((string)$child1 !== (string)$child2) {
                    return false;
                }
                if (!compareXml($child1, $child2)) {
                    return false;
                }
                $found = true;
                break;
            }
        }
        if (!$found) {
            return false;
        }
    }

    return true;
}

function sxml_append(SimpleXMLElement $to, SimpleXMLElement $from) {
    $toDom = dom_import_simplexml($to);
    $fromDom = dom_import_simplexml($from);
    $toDom->appendChild($toDom->ownerDocument->importNode($fromDom, true));
}