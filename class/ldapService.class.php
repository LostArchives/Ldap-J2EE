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

class ldapService {

    private static $instance;
    private $ldapHost = "localhost";
    private $ldapBaseDn = "dc=bla,dc=com";
    private $ldapUser = "cn=admin";
    private $ldapPassword = "bla";

    public static function getInstance() : ldapService {
        if (self::$instance == null) {
            self::$instance = new ldapService();
        }
        return self::$instance;
    }

    /**
     * Function to return a ldap connection (null if the connection fails)
     * @return null|resource
     */
    public function getConnection() {
        $ldapconn = ldap_connect($this->ldapHost)
        or die("Could not connect to LDAP server.");

        if ($ldapconn) {

            ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);
            ldap_set_option($ldapconn, LDAP_OPT_REFERRALS, 0); // To be able to do search query
        }
        return $ldapconn;
    }

    private function getBindUser() {
        return $this->ldapUser.",".$this->ldapBaseDn;
    }

    /**
     * @return ldapUser[]
     */
    public function getUsers() {
        $users = array();
        $ldapConn = $this->getConnection();
        $ldapbind = ldap_bind($ldapConn, $this->getBindUser(), $this->ldapPassword);
        if ($ldapbind) {
            $search_filter = '(objectClass=person)';
            $attributes = ["givenname","samaccountname","sn"];
            $result = ldap_search($ldapConn, $this->ldapBaseDn, $search_filter, $attributes);
            if (FALSE !== $result){
                $entries = ldap_get_entries($ldapConn, $result);
                for ($cnt = 0; $cnt < count($entries); $cnt++) {
                    $surname = $entries[$cnt]["sn"][0];
                    $name = $entries[$cnt]["givenname"][0];
                    if (!empty($surname) && !empty($name)) {
                        $user = new ldapUser($surname,$name);
                        $users[] = $user;
                    }
                }
            }
            ldap_unbind($ldapConn);
            ldap_close($ldapConn);
        } else {
            echo "LDAP bind failed...". ldap_error($ldapConn);
        }
        return $users;
    }
}



?>