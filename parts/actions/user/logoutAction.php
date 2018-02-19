<?php
/**
 * Created by PhpStorm.
 * User: Valentin
 * Date: 19/02/2018
 * Time: 13:19
 */
session_start();
include_once(dirname(__FILE__, 4) . "/class/util/viewUtil.class.php");

session_destroy();
header('Location: http://' . $_SERVER['SERVER_NAME'] . '/ldap/index.php');
exit();