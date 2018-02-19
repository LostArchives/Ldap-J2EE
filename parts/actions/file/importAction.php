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
$result = 0;

if ($_POST['format'] == 'csv' || $_POST['format'] == 'json') {
    $upload = $fileService->isUploadValid($_POST['format']);
    if ($upload != false) {
        $result = $fileService->importJson($upload);
    }
    header('Location: http://' . $_SERVER['SERVER_NAME'] . '/ldap/index.php?'. viewUtil::$viewId. '=0&message=true&type=success&action=import&param='.$result);
}