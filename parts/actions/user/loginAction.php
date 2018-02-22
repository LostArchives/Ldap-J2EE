<?php
/**
 * Created by PhpStorm.
 * User: Valentin
 * Date: 19/02/2018
 * Time: 13:08
 */
session_start();
include_once(dirname(__FILE__, 4) . "/class/ldapConnect.class.php");
include_once(dirname(__FILE__, 4) . "/class/util/viewUtil.class.php");

$password = $_POST["password"];
$success = false;
$ldapConnect = ldapConnect::getInstance();

if (isset($password)) {
    $success = $ldapConnect->loginAdmin($password);
    if ($success) {
        $_SESSION["logged"] = true;
        header('Location: http://' . $_SERVER['SERVER_NAME'] . '/ldap/index.php');
    }
    else
        header('Location: http://' . $_SERVER['SERVER_NAME'] . '/ldap/index.php?'. viewUtil::$viewId. '=0&message=true&type=danger&action=login');
}
else {
    header('Location: http://' . $_SERVER['SERVER_NAME'] . '/ldap/index.php?'. viewUtil::$viewId. '=0');
}

?>





