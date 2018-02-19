<?php
/**
 * Created by PhpStorm.
 * User: Valentin
 * Date: 19/02/2018
 * Time: 10:21
 */

include_once(dirname(__FILE__, 4) . "/class/services/ldapFileService.class.php");
include_once(dirname(__FILE__, 4) . "/class/util/viewUtil.class.php");

$fileService = ldapFileService::getInstance();

if ($_POST['format'] == 'csv') {
    $fileService->exportToCSV("ldapExport.csv");
}

if ($_POST['format'] == 'json') {
    $fileService->exportToJSON("ldapExport.json");
}