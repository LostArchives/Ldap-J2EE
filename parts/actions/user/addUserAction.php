<?php
/**
 * Created by PhpStorm.
 * User: jbuisine
 * Date: 1/29/18
 * Time: 10:06 AM
 */

//getting ldap service
include_once(dirname(__FILE__, 4) . "/class/services/ldapUserService.class.php");
include_once(dirname(__FILE__, 4) . "/class/bean/ldapUser.class.php");
include_once(dirname(__FILE__, 4) . "/class/util/viewUtil.class.php");

$ldapUserService = ldapUserService::getInstance();

// retrieving and checking data from add user form
// default empty array
$errors = array();

// check data
if(!isset($_POST['userName'])){
    $errors = "Please select correct user name";
}
if(!isset($_POST['userSurname'])){
    $errors = "Please select correct user surname";
}
if(!isset($_POST['userDescription'])){
    $errors = "Please select correct user's description";
}
if(!isset($_POST['userHomeDirectory'])){
    $errors = "Please select correct user's home directory";
}

// check errors
if(!empty($errors)){
    foreach ($errors as &$error): ?>
        <p style="color:red;"> <?php echo $error ?> </p>
   <?php endforeach;
}else{

    // getting form data
    $userName = $_POST['userName'];
    $userSurname = $_POST['userSurname'];
    $userDescription = $_POST['userDescription'];
    $userHomeDirectory = $_POST['userHomeDirectory'];

    $user = new ldapUser($userName, $userSurname, null, $userDescription, $userHomeDirectory);

    $ldapUserService->addUser($user);

    // redirect to home page
    header('location:http://' . $_SERVER['SERVER_NAME'] . '/ldap/index.php?'. viewUtil::$viewId. '=0');
}
