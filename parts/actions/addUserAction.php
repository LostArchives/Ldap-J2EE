<?php
/**
 * Created by PhpStorm.
 * User: jbuisine
 * Date: 1/29/18
 * Time: 10:06 AM
 */

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
if(!isset($_POST['userPassword'])){
    $errors = "Please select correct user password";
}
if(!isset($_POST['userRepeatPassword'])){
    $errors = "Please select correct user password";
}
if($_POST['userPassword'] != $_POST['userRepeatPassword']){
    $errors = "Please select same password";
}

// check errors
if(!empty($errors)){
    foreach ($errors as &$error){
        echo htmlspecialchars('<p style="color:red;">'.$error.'</p>');
    }
}else{

    // getting form data
    $userId = $_POST['userId'];
    $userName = $_POST['userName'];
    $userSurname = $_POST['userSurname'];
    $userPassword = $_POST['userPassword'];

    // TODO check add user parameters (need to add group ?)
    $ldapService->addUser($userId, $userName, $userSurname, $userPassword);
}
