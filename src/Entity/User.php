<?php

namespace App\Entity;

use JsonSerializable;

class User implements JsonSerializable
{
    /** @var string */
    private $login = '';

    /** @var string */
    private $password = '';

    /** @var string */
    private $title = '';

    /** @var string */
    private $lastName = '';

    /** @var string */
    private $firstName = '';

    /** @var string */
    private $gender = '';

    /** @var string */
    private $email = '';

    /** @var string */
    private $picture = '';

    /** @var string */
    private $address = '';

    /**
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param string $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param string $gender
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * @param string $picture
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }


    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'login' => $this->login,
            'password' => $this->password,
            'title' => $this->title,
            'lastName' => $this->lastName,
            'firstName' => $this->firstName,
            'gender' => $this->gender,
            'email' => $this->email,
            'picture' => $this->picture,
            'address' => $this->address
        ];
    }
}