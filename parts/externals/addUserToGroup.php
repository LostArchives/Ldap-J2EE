<?php
/**
 * Created by PhpStorm.
 * User: jbuisine
 * Date: 2/1/18
 * Time: 2:57 PM
 */

//getting ldap service
include_once(dirname(__FILE__, 3) . "/class/services/ldapGroupService.class.php");
include_once(dirname(__FILE__, 3) . "/class/bean/ldapGroup.class.php");

$ldapGroupService = ldapGroupService::getInstance();

// check data
if(!isset($_POST['dn']) && !isset($_POST['uid'])){

    header('Content-Type: application/json');
    echo json_encode("Unknown dn or uid");
}else{

    // getting form data
    $dn = $_POST['dn'];
    $uid = $_POST['uid'];

    $ldapGroupService->addUserToGroup($dn, $uid);

    header('Content-Type: application/json');
    echo json_encode("success");
}
