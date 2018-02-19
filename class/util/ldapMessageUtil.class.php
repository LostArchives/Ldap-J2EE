<?php
/**
 * Created by PhpStorm.
 * User: Valentin
 * Date: 19/02/2018
 * Time: 12:36
 */

class ldapMessageUtil
{

    private static $instance = null;

    private function __construct()
    {
    }

    public static function getInstance(): ldapMessageUtil
    {
        if (self::$instance == null) {
            self::$instance = new ldapMessageUtil();
        }
        return self::$instance;
    }

    public function getSuccessMessage($action,$param) {
        $message = "";
        switch($action) {
            case "add_user":
                $message = "User added successfully";
                break;
            case "modifiy_user":
                $message = "User modified successfully";
                break;
            case "delete_user":
                $message = "User deleted successfully";
                break;
            case "add_group":
                $message = "Group added successfully";
                break;
            case "modify_group":
                $message = "Group modified successfully";
                break;
            case "delete_group":
                $message = "Group deleted successfully";
                break;
            case "import":
                $message = $param." elements imported successfully";
                break;
            case "login":
                $message = "Successful login";
                break;
            case "logout":
                $message = "You have been logout successfully";
                break;

        }
        return $message;
    }

    public function getErrorMessage($action,$param) {
        $message = "";
        switch($action) {
            case "add_user":
                $message = "Error while adding user";
                break;
            case "modifiy_user":
                $message = "Error while modifying user";
                break;
            case "delete_user":
                $message = "Error while deleting user";
                break;
            case "add_group":
                $message = "Error while adding user";
                break;
            case "modify_group":
                $message = "Error while modifying group";
                break;
            case "delete_group":
                $message = "Error while deleting group";
                break;
            case "import":
                $message = "Error while importing elements";
                break;
            case "login":
                $message = "Bad login or password";
                break;
            case "logout":
                $message = "Logout error";
                break;

        }
        return $message;
    }

}