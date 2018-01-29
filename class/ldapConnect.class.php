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

class ldapConnect {

    private static $instance;
    private $ldapHost = "localhost";
    private $ldapBaseDn = "dc=bla,dc=com";
    private $ldapUser = "cn=admin";
    private $ldapPassword = "bla";

    public static function getInstance(): ldapConnect
    {
        if (self::$instance == null) {
            self::$instance = new ldapConnect();
        }
        return self::$instance;
    }

    /**
     * @return string
     */
    public function getLdapBaseDn(): string
    {
        return $this->ldapBaseDn;
    }

    public function connect()
    {
        $ldapConn = $this->getConnection();
        $bind = ldap_bind($ldapConn, $this->getBindUser(), $this->ldapPassword);
        if ($bind)
            return $ldapConn;
        else
            return null;
    }

    /**
     * Function to return a ldap connection (null if the connection fails)
     * @return null|resource
     */
    private function getConnection()
    {
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

    public function disconnect($conn)
    {
        ldap_unbind($conn);
        ldap_close($conn);
    }

}



?>