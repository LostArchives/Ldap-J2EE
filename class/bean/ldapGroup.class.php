<?php

/**
 * Created by PhpStorm.
 * User: Valentin
 * Date: 29/01/2018
 * Time: 14:16
 */
class ldapGroup
{
    private $name;
    private $dn;

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
}

?>