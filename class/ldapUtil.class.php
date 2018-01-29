<?php

/**
 * Created by PhpStorm.
 * User: Valentin
 * Date: 29/01/2018
 * Time: 11:41
 */

/**
 * Class ldapUtil
 * Util class for ldap project
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

    public function buildUserDn($surname, $name)
    {
        return "uid=" . $name[0].$surname . ",ou=people," . ldapConnect::$ldapBaseDn;
    }

    public function buildUserDnWithUid($uid)
    {
        return "uid=" . $uid . ",ou=people," . ldapConnect::$ldapBaseDn;
    }
}


?>