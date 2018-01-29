<?php

/**
 * Created by PhpStorm.
 * User: Valentin
 * Date: 29/01/2018
 * Time: 14:12
 */
class ldapGroupService
{

    private static $instance = null;

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

    }


}


?>