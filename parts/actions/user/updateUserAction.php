<?php
/**
 * Created by PhpStorm.
 * User: jbuisine
 * Date: 1/29/18
 * Time: 10:06 AM
 */

//getting ldap service
include_once(dirname(__FILE__, 4) . "/class/bean/ldapUser.class.php");
include_once(dirname(__FILE__, 4) . "/class/services/ldapUserService.class.php");
$ldapUserService = ldapUserService::getInstance();

// retrieving and checking data from add user form
// default empty array
$errors = array();

// check data
if(!isset($_POST['uid'])){
    $errors = "Please select correct uid";
}
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
    $uid = $_POST['uid'];
    $userName = $_POST['userName'];
    $userSurname = $_POST['userSurname'];

    $user = new ldapUser($userSurname, $userName, $uid);

    $ldapUserService->updateUser($user);

    // redirect to home page
    header('location:http://'.$_SERVER['SERVER_NAME'].'/ldap/index.php');
}
