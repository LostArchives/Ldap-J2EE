<?php

/**
 * Created by PhpStorm.
 * User: Valentin
 * Date: 29/01/2018
 * Time: 14:12
 */

include_once(dirname(__FILE__, 2) . "/ldapConnect.class.php");
include_once(dirname(__FILE__, 2) . "/bean/ldapGroup.class.php");
include_once(dirname(__FILE__, 2) . "/util/ldapUtil.class.php");

class ldapGroupService
{

    private static $instance = null;
    private static $GROUP_TOP_CLASS = "top";
    private static $GROUP_POSIX_CLASS = "posixGroup";
    private $ldapConnect;
    private $ldapUtil;

    private function __construct()
    {
        $this->ldapConnect = ldapConnect::getInstance();
        $this->ldapUtil = ldapUtil::getInstance();
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

    /**
     * Method which returns group
     *
     * @param $dn
     * @return ldapGroup
     */
    public function getGroup($dn) : ldapGroup{

        $connection = $this->ldapConnect->connect();

        if($connection != null){

            $search_filter = '(objectClass=posixGroup)';

            $result = ldap_search($connection, $dn, $search_filter);
            if (FALSE !== $result) {
                $entries = ldap_get_entries($connection, $result);

                for ($cnt = 0; $cnt < count($entries); $cnt++) {
                    $name = $entries[$cnt]["cn"][0];
                    $dn = $entries[$cnt]["dn"];
                    $uids = $entries[$cnt]["memberuid"];

                    $mUids = array();

                    // get all memberUid of group
                    while ($mid = current($uids)) {

                        if (is_int(key($uids))) {
                            array_push($mUids, $mid);
                        }
                        next($uids);
                    }


                    if (!empty($name) && !empty($dn)) {

                        $group = new ldapGroup($name, $dn);
                        $group->setMemberUid($mUids);

                        return $group;
                    }
                }
            }

            $this->ldapConnect->disconnect($connection);

        }else{
            echo "LDAP connection failed..." . ldap_error($connection);
        }

        return null;
    }

    public function addUserToGroup($dn, $uid){

        $success = false;
        $connection = $this->ldapConnect->connect();

        if ($connection != null) {

            // another time check var
            if (!empty($dn) && !empty($uid)) {

                // remove user from group
                $info["memberuid"] = $uid;

                // add data to directory
                $success = ldap_mod_add($connection, $dn, $info);

                if (!$success) {
                    echo ldap_error($connection);
                }
                echo ldap_error($connection);
            }
            $this->ldapConnect->disconnect($connection);
        } else {
            echo "LDAP connection failed..." . ldap_error($connection);
        }
        return $success;
    }

    public function delUserOfGroup($dn, $uid){

        $success = false;
        $connection = $this->ldapConnect->connect();

        if ($connection != null) {

            // another time check var
            if (!empty($dn) && !empty($uid)) {

                // remove user from group
                $info["memberuid"] = $uid;

                // add data to directory
                $success = ldap_mod_del($connection, $dn, $info);

                if (!$success) {
                    echo ldap_error($connection);
                }
            }
            $this->ldapConnect->disconnect($connection);
        } else {
            echo "LDAP connection failed..." . ldap_error($connection);
        }
        return $success;
    }


    public function addGroup($name): bool
    {
        $success = false;
        $connection = $this->ldapConnect->connect();

        if ($connection != null) {

            // another time check var
            if (!empty($name)) {


                $dn = $this->ldapUtil->buildGroupDn($name);

                $info["cn"] = $name;

                $idNumber = (9999 - count($this->getGroups()));

                $info["gidNumber"] = $idNumber;
                $info['objectClass'][0] = self::$GROUP_TOP_CLASS;
                $info['objectClass'][1] = self::$GROUP_POSIX_CLASS;

                // add data to directory
                $success = ldap_add($connection, $dn, $info);

                if (!$success) {
                    echo $name. "\n";
                    echo $dn . "\n";
                    echo ldap_error($connection);
                }
            }
            $this->ldapConnect->disconnect($connection);
        } else {
            echo "LDAP connection failed..." . ldap_error($connection);
        }
        return $success;
    }

    public function delGroup($dn): bool
    {

        $success = false;
        $connection = $this->ldapConnect->connect();

        if ($connection != null) {
            // delete user by uid
            $success = ldap_delete($connection, $dn);
            if (!$success) {
                echo ldap_error($connection);
            }
        } else {
            echo "LDAP connection failed..." . ldap_error($connection);
        }
        return $success;
    }

    public function delAllGroups(): bool {
        $groups = $this->getGroups();
        foreach($groups as $group) {
            $this->delGroup($group->getDn());
        }
        return true;
    }

    public function isGroupEmpty(ldapGroup $group): bool
    {
        return (empty($group->getName())
             || empty($group->getDn()));
    }
}

?>