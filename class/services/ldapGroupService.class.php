<?php

/**
 * Created by PhpStorm.
 * User: Valentin
 * Date: 29/01/2018
 * Time: 14:12
 */

include_once(dirname(__FILE__, 2) . "/ldapConnect.class.php");
include_once(dirname(__FILE__, 2) . "/bean/ldapGroup.class.php");

class ldapGroupService
{

    private static $instance = null;
    private $ldapConnect;

    private function __construct()
    {
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new ldapGroupService();
        }
        return self::$instance;
    }

    public function getGroups()
    {
        //$ldapConnect
    }


}


?>