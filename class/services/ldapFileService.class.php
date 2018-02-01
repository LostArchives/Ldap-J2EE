<?php

include_once(dirname(__FILE__, 2) . "/ldapConnect.class.php");

class ldapFileService
{

    public static $CSV_DELIMITER = ";";
    private static $instance = null;
    private $ldapConnect;

    private function __construct()
    {
        $this->ldapConnect = ldapConnect::getInstance();
    }

    public static function getInstance(): ldapFileService
    {
        if (self::$instance == null) {
            self::$instance = new ldapFileService();
        }
        return self::$instance;
    }


    public function exportToCSV($fileName)
    {
        $connection = $this->ldapConnect->connect();
        $temp_memory = null;
        if ($connection != null) {
            $search_filter = '(&(objectClass=*)';
            $domainDn = ldapConnect::$ldapBaseDn;
            $result = ldap_search($connection, $domainDn, $search_filter);
            if (FALSE !== $result) {
                $entries = ldap_get_entries($connection, $result);
                $temp_memory = fopen('php://memory', 'w');
                foreach ($entries as $line) {
                    fputcsv($temp_memory, $line, self::$CSV_DELIMITER);
                }
                fseek($temp_memory, 0);
            }
            header('Content-Type: application/csv');
            header('Content-Disposition: attachement; filename="' . $fileName . '";');
            fpassthru($temp_memory);
            $this->ldapConnect->disconnect($connection);
        } else {
            echo "LDAP connection failed..." . ldap_error($connection);
        }

    }

    public function exportToJSON($fileName)
    {
        $connection = $this->ldapConnect->connect();
        $temp_memory = null;
        if ($connection != null) {
            $search_filter = '(objectClass=*)';
            $domainDn = ldapConnect::$ldapBaseDn;
            $result = ldap_search($connection, $domainDn, $search_filter);
            $entries = array();
            if (FALSE !== $result) {
                $entries = json_encode(ldap_get_entries($connection, $result));
            }
            header('Content-Type: application/csv');
            header('Content-Disposition: attachement; filename="' . $fileName . '";');
            echo $entries;
            $this->ldapConnect->disconnect($connection);
        } else {
            echo "LDAP connection failed..." . ldap_error($connection);
        }

    }
}

?>