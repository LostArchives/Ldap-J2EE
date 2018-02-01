<?php

/**
 * Created by PhpStorm.
 * User: Valentin
 * Date: 29/01/2018
 * Time: 09:41
 */
class ldapUser implements JsonSerializable
{

    private $surname;
    private $name;
    private $uid;
    private $description;
    private $homeDirectory;


    public function __construct($surname, $name, $uid, $description, $homeDirectory)
    {
        $this->surname = $surname;
        $this->name = $name;
        $this->uid = $uid;
        $this->description = $description;
        $this->homeDirectory = $homeDirectory;
    }

    /**
     * @return mixed
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * @param mixed $surname
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;
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
    public function getUid()
    {
        return $this->uid;
    }

    /**
     * @param mixed $uid
     */
    public function setUid($uid)
    {
        $this->uid = $uid;
    }

    /**
     * @return mixed
     */
    public function getHomeDirectory()
    {
        return $this->homeDirectory;
    }

    /**
     * @param mixed $homeDirectory
     */
    public function setHomeDirectory($homeDirectory)
    {
        $this->homeDirectory = $homeDirectory;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
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

        $data["name"] = $this->name;
        $data["surname"] = $this->surname;
        $data["uid"] = $this->uid;
        $data["description"] = $this->description;
        $data["homeDirectory"] = $this->homeDirectory;

        return $data;
    }
}

?>