<?php
/**
 * Created by PhpStorm.
 * User: jbuisine
 * Date: 1/29/18
 * Time: 10:06 AM
 */

//getting ldap service
include_once(dirname(__FILE__, 3) . "/class/services/ldapGroupService.class.php");
include_once(dirname(__FILE__, 3) . "/class/bean/ldapGroup.class.php");

$ldapGroupService = ldapGroupService::getInstance();

// check data
if(!isset($_POST['dn'])){

    header('Content-Type: application/json');
    echo json_encode("Unknown dn");
}else{

    // getting form data
    $dn = $_POST['dn'];

    $group = $ldapGroupService->getGroup($dn);

    header('Content-Type: application/json');
    echo json_encode($group);
}
