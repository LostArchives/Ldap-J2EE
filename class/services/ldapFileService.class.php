<?php

include_once(dirname(__FILE__, 2) . "/ldapConnect.class.php");
include_once("ldapGroupService.class.php");
include_once("ldapUserService.class.php");

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
            $search_filter = '(objectClass=*)';
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

    public function importJson($json)
    {
        $content = json_decode($json, true);
        $count = 0;
        $userService = ldapUserService::getInstance();
        foreach ($content as $key => $elem) {
            if ($elem["dn"] != null) {
                if (in_array('posixGroup', $elem['objectclass'])) {
                    $groupName = $elem["cn"][0];
                    ldapGroupService::getInstance()->addGroup($groupName);
                    $count++;
                }
                if (in_array('person', $elem['objectclass'])) {
                    $surname = $elem["sn"][0];
                    $name = $elem["givenname"][0];
                    $uid = $name[0]. " ".$surname;
                    $description = $elem["description"][0] == null ? "N/A" : $elem["description"][0];
                    $homeDirectory = $elem["homedirectory"][0] == null ? "N/A" : $elem["homedirectory"][0];
                    $ldapUser = new ldapUser($surname,$name,$uid,$description,$homeDirectory);
                    $userService->addUser($ldapUser);
                    $count++;
                }
            }
        }
        return $count;
    }

    public function isUploadValid($format)
    {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $fileType = pathinfo($target_file, PATHINFO_EXTENSION);

        // Allow certain file formats
        if ($fileType != $format) {
            return false;
        } else {
            return file_get_contents($_FILES["fileToUpload"]["tmp_name"]);
        }
    }

}

?>