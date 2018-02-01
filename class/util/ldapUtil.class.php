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
        return "uid=" . $name[0] . $surname . ",ou=people," . ldapConnect::$ldapBaseDn;
    }

    public function buildUserDnWithUid($uid)
    {
        return "uid=" . $uid . ",ou=people," . ldapConnect::$ldapBaseDn;
    }

    public function buildGroupDn($name)
    {
        return "cn=" . $name . ",ou=group," . ldapConnect::$ldapBaseDn;
    }

    public function clearLdap($recursive): bool
    {
        $ldapConnect = ldapConnect::getInstance();
        $connect = $ldapConnect->connect();
        $dn = ldapConnect::$ldapBaseDn;

        if ($connect != null) {
            if ($recursive == false) {
                return (ldap_delete($connect, $dn));
            } else {
                $sr = ldap_list($connect, $dn, "ObjectClass=*");
                $entries = ldap_get_entries($connect, $sr);
                $count = $entries['count'];
                for ($i = 0; $i < $count; $i++) {
                    $result = $this->clearLdap($recursive);
                    if (!$result) {
                        return $result;
                    }
                }
                $result = ldap_delete($connect, $dn);
            }
            $ldapConnect->disconnect($connect);
            return $result;
        } else {
            echo "LDAP connection failed..." . ldap_error($connect);
        }

        return false;
    }
}


?>