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
    private static $GROUP_TOP_CLASS = "top";
    private static $GROUP_POSIX_CLASS = "posixGroup";
    private $ldapConnect;

    private function __construct()
    {
        $this->ldapConnect = ldapConnect::getInstance();
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new ldapGroupService();
        }
        return self::$instance;
    }

    /**
     * @return ldapGroup[]
     */
    public function getGroups()
    {
        $groups = array();
        $connection = $this->ldapConnect->connect();
        $domainDn = ldapConnect::$ldapBaseDn;
        if ($connection != null) {
            $search_filter = '(objectClass=posixGroup)';
            $attributes = ["cn"];
            $result = ldap_search($connection, $domainDn, $search_filter, $attributes);
            if (FALSE !== $result) {
                $entries = ldap_get_entries($connection, $result);
                for ($cnt = 0; $cnt < count($entries); $cnt++) {
                    $name = $entries[$cnt]["cn"][0];
                    $dn = $entries[$cnt]["dn"];
                    if (!empty($name) && !empty($dn)) {
                        $group = new ldapGroup($name, $dn);
                        $groups[] = $group;
                    }
                }
            }
            $this->ldapConnect->disconnect($connection);
        } else {
            echo "LDAP connection failed..." . ldap_error($connection);
        }
        return $groups;

    }

    public function addGroup($name)
    {
        $success = false;
        $connection = $this->ldapConnect->connect();

        if ($connection != null) {

            // another time check var
            if (!empty($name) && !empty($surname)) {

                $info["cn"] = $name;
                $info['objectClass'][0] = self::$GROUP_TOP_CLASS;
                $info["objectClass"][1] = self::$GROUP_POSIX_CLASS;

                $dn = "";
                // add data to directory
                $success = ldap_add($connection, $dn, $info);

                if (!$success) {
                    //echo ldap_error($connection);
                }
            }
            $this->ldapConnect->disconnect($connection);
        } else {
            echo "LDAP connection failed..." . ldap_error($connection);
        }
        return $success;
    }

}

?>