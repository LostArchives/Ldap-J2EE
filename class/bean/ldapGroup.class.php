<?php

/**
 * Created by PhpStorm.
 * User: Valentin
 * Date: 29/01/2018
 * Time: 14:16
 */
class ldapGroup implements JsonSerializable
{
    private $name;
    private $dn;
    private $memberUid;

    /**
     * ldapGroup constructor.
     * @param $name
     * @param $uid
     */
    public function __construct($name, $uid)
    {
        $this->name = $name;
        $this->dn = $uid;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getDn()
    {
        return $this->dn;
    }

    /**
     * @param mixed $uid
     */
    public function setDn($dn)
    {
        $this->dn = $dn;
    }

    /**
     * @return mixed
     */
    public function getMemberUid()
    {
        return $this->memberUid;
    }

    /**
     * @param mixed $memberUid
     */
    public function setMemberUid($memberUid)
    {
        $this->memberUid = $memberUid;
    }

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        $data = array();

        $data["dn"] = $this->dn;
        $data["name"] = $this->name;
        $data["memberUid"] = $this->memberUid;

        return $data;
    }
}

?>