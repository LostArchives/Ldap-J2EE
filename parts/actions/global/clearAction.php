<?php
/**
 * Created by PhpStorm.
 * User: Valentin
 * Date: 22/02/2018
 * Time: 08:50
 */
include_once(dirname(__FILE__, 4) . "/class/services/ldapUserService.class.php");
include_once(dirname(__FILE__, 4) . "/class/services/ldapGroupService.class.php");
include_once(dirname(__FILE__, 4) . "/class/util/viewUtil.class.php");


ldapUserService::getInstance()->delAllUsers();
ldapGroupService::getInstance()->delAllGroups();

header('location:http://' . $_SERVER['SERVER_NAME'] . '/ldap/index.php?'. viewUtil::$viewId. '=0&message=true&type=success&action=clear');
?>