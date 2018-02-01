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
            $attributes = ["givenname", "samaccountname", "sn", "uid", "description", "homedirectory"];
            $result = ldap_search($connection, $domainDn, $search_filter, $attributes);
            if (FALSE !== $result) {
                $entries = ldap_get_entries($connection, $result);
                for ($cnt = 0; $cnt < count($entries); $cnt++) {
                    $surname = $entries[$cnt]["sn"][0];
                    $name = $entries[$cnt]["givenname"][0];
                    $uid = $entries[$cnt]["uid"][0];
                    $description = $entries[$cnt]["description"][0];
                    $homeDirectory = $entries[$cnt]["homedirectory"][0];
                    if (!empty($surname) && !empty($name)) {
                        $user = new ldapUser($surname, $name, $uid, $description, $homeDirectory);
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
    public function addUser(ldapUser $user)
    {
        $success = false;
        $connection = $this->ldapConnect->connect();

        if ($connection != null) {

            // another time check var
            if (!$this->isUserEmpty($user)) {

                $info["uid"] = $user->getName()[0] . $user->getSurname();
                $info["cn"] = $user->getName() . " " . $user->getSurname();
                $info["sn"] = $user->getSurname();

                $idNumber = (1100 - count($this->getUsers()));
                $info["uidNumber"] = $idNumber;
                $info["gidNumber"][0] = $idNumber;

                $info["givenname"] = $user->getName();
                $info["description"] = $user->getDescription();
                $info["homedirectory"] = $user->getHomeDirectory();
                $info['objectClass'][0] = self::$USER_TOP_CLASS;
                $info["objectClass"][1] = self::$USER_PERSON_CLASS;
                $info["objectClass"][2] = self::$USER_INET_CLASS;

                $dn = $this->ldapUtil->buildUserDn($user->getSurname(), $user->getName());
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

    public function updateUser(ldapUser $user)
    {

        $success = false;
        $connection = $this->ldapConnect->connect();

        if ($connection != null) {

            if (!$this->isUserEmpty($user)) {

                // update values
                $info["cn"] = $user->getName() . " " . $user->getSurname();
                $info["sn"] = $user->getSurname();
                $info["givenname"] = $user->getName();
                $info["description"] = $user->getDescription();
                $info["homeDirectory"] = $user->getHomeDirectory();

                // build dn with a known uid
                $dn = $this->ldapUtil->buildUserDnWithUid($user->getUid());
                echo $dn;

                // update user by uid
                $success = ldap_modify($connection, $dn, $info);
                echo ldap_error($connection);

            } else {
                echo "User does not have correct fields";
            }

        } else {
            echo "LDAP connection failed..." . ldap_error($connection);
        }

        return $success;
    }

    public function delUser($uid): bool
    {

        $success = false;
        $connection = $this->ldapConnect->connect();

        if ($connection != null) {

            // build dn with a known uid
            $dn = $this->ldapUtil->buildUserDnWithUid($uid);

            // delete user by uid
            $success = ldap_delete($connection, $dn);

        } else {
            echo "LDAP connection failed..." . ldap_error($connection);
        }

        return $success;
    }

    /**
     * Utils function which checks if user is empty or not
     *
     * @param ldapUser $user
     * @return bool
     */
    public function isUserEmpty(ldapUser $user): bool
    {
        return (empty($user->getName())
            || empty($user->getSurname())
            || empty($user->getDescription())
            || empty($user->getHomeDirectory()));
    }
}

?>