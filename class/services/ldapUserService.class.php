<?php
/**
 * Created by PhpStorm.
 * User: Valentin
 * Date: 29/01/2018
 * Time: 09:37
 */

/**
 * Class ldapService
 * A singleton class to interact with OpenLdap active diretory
 */

include_once(dirname(__FILE__, 2) . "/bean/ldapUser.class.php");
include_once(dirname(__FILE__, 2) . "/ldapConnect.class.php");
include_once(dirname(__FILE__, 2) . "/util/ldapUtil.class.php");

class ldapUserService
{

    private static $USER_TOP_CLASS = "top";
    private static $USER_PERSON_CLASS = "person";
    private static $USER_INET_CLASS = "inetOrgPerson";
    private static $instance;
    private $ldapConnect;
    private $ldapUtil;

    private function __construct()
    {
        $this->ldapConnect = ldapConnect::getInstance();
        $this->ldapUtil = ldapUtil::getInstance();
    }

    public static function getInstance(): ldapUserService
    {
        if (self::$instance == null) {
            self::$instance = new ldapUserService();
        }
        return self::$instance;
    }

    /**
     * @return ldapUser[]
     */
    public function getUsers()
    {
        $users = array();
        $connection = $this->ldapConnect->connect();
        $domainDn = ldapConnect::$ldapBaseDn;
        if ($connection != null) {
            $search_filter = '(objectClass=person)';
            $attributes = ["givenname", "samaccountname", "sn", "uid"];
            $result = ldap_search($connection, $domainDn, $search_filter, $attributes);
            if (FALSE !== $result) {
                $entries = ldap_get_entries($connection, $result);
                for ($cnt = 0; $cnt < count($entries); $cnt++) {
                    $surname = $entries[$cnt]["sn"][0];
                    $name = $entries[$cnt]["givenname"][0];
                    $uid = $entries[$cnt]["uid"][0];
                    if (!empty($surname) && !empty($name)) {
                        $user = new ldapUser($surname, $name, $uid);
                        $users[] = $user;
                    }
                }
            }
            $this->ldapConnect->disconnect($connection);
        } else {
            echo "LDAP connection failed..." . ldap_error($connection);
        }
        return $users;
    }

    /**
     * Service method which add new user
     *
     * @param $name
     * @param $surname
     */
    public function addUser($name, $surname)
    {
        $connection = $this->ldapConnect->connect();

        if ($connection != null) {

            // another time check var
            if (!empty($name) && !empty($surname)) {

                $info["uid"] = $name[0] . $surname;
                $info["cn"] = $name . " " . $surname;
                $info["sn"] = $surname;
                $info["givenname"] = $name;
                $info['objectClass'][0] = self::$USER_TOP_CLASS;
                $info["objectClass"][1] = self::$USER_PERSON_CLASS;
                $info["objectClass"][2] = self::$USER_INET_CLASS;

                $dn = $this->ldapUtil->buildUserDn($surname, $name);
                // add data to directory
                $r = ldap_add($connection, $dn, $info);
                if (!$r) {
                    //echo ldap_error($connection);
                }
            }
            $this->ldapConnect->disconnect($connection);
        } else {
            echo "LDAP connection failed..." . ldap_error($connection);
        }
    }
}

?>