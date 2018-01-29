<?php
/**
 * Created by PhpStorm.
 * User: Valentin
 * Date: 29/01/2018
 * Time: 09:41
 */

class ldapUser {

private $surname;
private $name;


    public function __construct($surname,$name)
    {
        $this->surname = $surname;
        $this->name = $name;
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
}

?>