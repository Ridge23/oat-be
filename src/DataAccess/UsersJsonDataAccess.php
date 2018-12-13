<?php

namespace App\DataAccess;

use App\Entity\User;
use App\Exception\IncorrectUserFieldValueException;

/**
 * Class UsersJsonDataAccess
 * @package App\DataAccess
 */
class UsersJsonDataAccess extends AbstractDataAccess
{
    protected $fileName = 'testtakers.json';

    /**
     * @param string $content
     *
     * @return array
     *
     * @throws IncorrectUserFieldValueException
     */
    public function serializeContent($content)
    {
        $entitiesArray = [];
        $contentArray = json_decode($content, true);

        foreach ($contentArray as $id => $userJson) {
            $newUser = new User();

            $newUser->setId($id);
            $newUser->setAddress($userJson['address']);
            $newUser->setEmail($userJson['email']);
            $newUser->setFirstName($userJson['firstname']);
            $newUser->setLastName($userJson['lastname']);
            $newUser->setGender($userJson['gender']);
            $newUser->setLogin($userJson['login']);
            $newUser->setPassword($userJson['password']);
            $newUser->setTitle($userJson['title']);
            $newUser->setPicture($userJson['picture']);

            $entitiesArray[] = $newUser;
        }

        return $entitiesArray;
    }
}
