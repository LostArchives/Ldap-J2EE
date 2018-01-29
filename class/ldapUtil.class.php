<?php

/**
 * Created by PhpStorm.
 * User: Valentin
 * Date: 29/01/2018
 * Time: 11:41
 */
class ldapUtil
{

    private static $instance = null;

    private function __construct()
    {
    }

    public static function getInstance(): ldapUtil
    {
        if (self::$instance == null) {
            self::$instance = new ldapUtil();
        }
        return self::$instance;
    }


}


?>