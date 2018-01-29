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
    private static $instance;

    public static function getInstance() : ldapUserService {
        if (self::$instance == null) {
            self::$instance = new ldapUserService();
        }
        return self::$instance;
    }

    private function __construct()
    {
        $this->ldapConnect = ldapConnect::getInstance();
    }

    /**
     * @return ldapUser[]
     */
    public function getUsers() {
        $users = array();
        $ldapConn = $this->ldapConnect->getConnection();
        $ldapbind = ldap_bind($ldapConn, $this->ldapConnect->getBindUser(), $this->ldapConnect->ldapPassword);
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

    /**
     * Service method which add new user
     *
     * @param $name
     * @param $surname
     */
    public function addUser($name, $surname){
        $ldapConn = $this->getConnection();
        $ldapbind = ldap_bind($ldapConn, $this->ldapConnect->getBindUser(), $this->ldapConnect->ldapPassword);

        if ($ldapbind) {

            // another time check

            if(!empty($name) && !empty($surname)){


                $dn = "cn=groupname,cn=groups,dc=example,dc=com";
                $entry['cn'] = $name;
                $entry['sn'] = $surname;
                $entry['objectClass'] = 'person';

                ldap_mod_add(l, $dn, $entry);
            }

            ldap_unbind($ldapConn);
            ldap_close($ldapConn);
        } else {
            echo "LDAP bind failed...". ldap_error($ldapConn);
        }
    }
}



?>