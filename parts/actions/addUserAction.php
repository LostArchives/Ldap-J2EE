<?php
/**
 * Created by PhpStorm.
 * User: jbuisine
 * Date: 1/29/18
 * Time: 10:06 AM
 */

//getting ldap service
include_once(dirname(__FILE__, 3) . "/class/services/ldapUserService.class.php");
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

// check errors
if(!empty($errors)){
    foreach ($errors as &$error): ?>
        <p style="color:red;"> <?php echo $error ?> </p>
   <?php endforeach;
}else{

    // getting form data
    $userName = $_POST['userName'];
    $userSurname = $_POST['userSurname'];

    $ldapUserService->addUser($userName, $userSurname);

    // redirect to home page
    header('location:http://' . $_SERVER['SERVER_NAME'] . '/ldap/index.php');
}
