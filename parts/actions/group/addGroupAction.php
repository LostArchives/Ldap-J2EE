<?php
/**
 * Created by PhpStorm.
 * User: jbuisine
 * Date: 1/29/18
 * Time: 10:06 AM
 */

//getting ldap service
include_once(dirname(__FILE__, 4) . "/class/services/ldapGroupService.class.php");
include_once(dirname(__FILE__, 4) . "/class/util/viewUtil.class.php");

$ldapGroupService = ldapGroupService::getInstance();

// retrieving and checking data from add user form
// default empty array
$errors = array();

// check data
if(!isset($_POST['groupName'])){
    $errors = "Please select correct group name";
}

// check errors
if(!empty($errors)){
    foreach ($errors as &$error): ?>
        <p style="color:red;"> <?php echo $error ?> </p>
   <?php endforeach;
}else{

    // getting form data
    $groupName = $_POST['groupName'];

    $ldapGroupService->addGroup($groupName);

    // redirect to home page
    header('location:http://' . $_SERVER['SERVER_NAME'] . '/ldap/index.php?'. viewUtil::$viewId. '=1');
}
