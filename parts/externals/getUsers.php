<?php
/**
 * Created by PhpStorm.
 * User: jbuisine
 * Date: 2/1/18
 * Time: 2:03 PM
 */


//getting ldap service
include_once(dirname(__FILE__, 3) . "/class/services/ldapUserService.class.php");
include_once(dirname(__FILE__, 3) . "/class/bean/ldapUser.class.php");

$ldapUserService = ldapUserService::getInstance();

$users = $ldapUserService->getUsers();

header('Content-Type: application/json');
echo json_encode($users);
