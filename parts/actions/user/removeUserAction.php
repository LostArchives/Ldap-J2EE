<?php
/**
 * Created by PhpStorm.
 * User: jbuisine
 * Date: 1/29/18
 * Time: 2:18 PM
 */

//getting ldap service
include_once(dirname(__FILE__, 4) . "/class/services/ldapUserService.class.php");
include_once(dirname(__FILE__, 4) . "/class/util/viewUtil.class.php");

$ldapUserService = ldapUserService::getInstance();

// retrieving and checking data from add user form
// default empty array
$errors = array();

// check data
if (!isset($_GET['uid'])) {
    $errors = "uid not found";
}
// check errors
if (!empty($errors)) {
    foreach ($errors as &$error): ?>
        <p style="color:red;"> <?php echo $error ?> </p>
    <?php endforeach;
} else {

    // getting form data
    $uid = $_GET['uid'];

    $ldapUserService->delUser($uid);

    // redirect to home page
    header('location:http://' . $_SERVER['SERVER_NAME'] . '/ldap/index.php?'. viewUtil::$viewId. '=0&message=true&type=success&action=delete_user');
}