<?php
/**
 * Created by PhpStorm.
 * User: jbuisine
 * Date: 1/29/18
 * Time: 10:06 AM
 */

// retrieving and checking data from add user form

// default empty array
$errors = [];

// check data
if(!isset($_POST['userId'])){
    $errors = "Please select correct user id";
}
if(!isset($_POST['userFirstname'])){
    $errors = "Please select correct user firstname";
}
if(!isset($_POST['userLastname'])){
    $errors = "Please select correct user lastname";
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
    $userFirstname = $_POST['userFirstname'];
    $userLastname = $_POST['userLastname'];
    $userPassword = $_POST['userPassword'];


    // TODO check add user parameters (need to add group ?)
    $ldapService->addUser($userId, $userFirstname, $userLastname, $userPassword);
}
