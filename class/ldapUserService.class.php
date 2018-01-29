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
include_once("ldapUser.class.php");
include_once("ldapConnect.class.php");

class ldapUserService {

    private $ldapConnect;

    public function __construct()
    {
        $this->ldapConnect = ldapConnect::getInstance();
    }

    /**
     * @return ldapUser[]
     */
    public function getUsers() {
        $users = array();
        $connection = $this->ldapConnect->connect();
        $domainDn = $this->ldapConnect->getLdapBaseDn();
        if ($connection != null) {
            $search_filter = '(objectClass=person)';
            $attributes = ["givenname","samaccountname","sn"];
            $result = ldap_search($connection, $domainDn, $search_filter, $attributes);
            if (FALSE !== $result){
                $entries = ldap_get_entries($connection, $result);
                for ($cnt = 0; $cnt < count($entries); $cnt++) {
                    $surname = $entries[$cnt]["sn"][0];
                    $name = $entries[$cnt]["givenname"][0];
                    if (!empty($surname) && !empty($name)) {
                        $user = new ldapUser($surname,$name);
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
    public function addUser($name, $surname){
        $connection = $this->ldapConnect->connect();

        if ($connection != null) {

            $dn = "cn=groupname,cn=groups,dc=example,dc=com";
            $entry['cn'] = $name;
            $entry['sn'] = $surname;
            $entry['objectClass'] = 'person';

            ldap_mod_add(l, $dn, $entry);

            $this->ldapConnect->disconnect($connection);
        } else {
            echo "LDAP connection failed..." . ldap_error($connection);
        }
    }
}



?>