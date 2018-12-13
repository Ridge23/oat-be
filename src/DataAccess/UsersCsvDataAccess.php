<?php

namespace App\DataAccess;

use App\Entity\User;
use App\Exception\IncorrectUserFieldValueException;

class UsersCsvDataAccess extends AbstractDataAccess
{
    protected $fileName = 'testtakers.csv';

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
        $contentArray =  str_getcsv($content, "\n");

        $titlesRow = str_getcsv(array_shift($contentArray), ",");

        foreach ($contentArray as $id => $userString) {
            $row = str_getcsv($userString, ",");

            $newUser = new User();

            $newUser->setId($id);
            $newUser->setAddress($row[array_search('address', $titlesRow)]);
            $newUser->setEmail($row[array_search('email', $titlesRow)]);
            $newUser->setFirstName($row[array_search('firstname', $titlesRow)]);
            $newUser->setLastName($row[array_search('lastname', $titlesRow)]);
            $newUser->setGender($row[array_search('gender', $titlesRow)]);
            $newUser->setLogin($row[array_search('login', $titlesRow)]);
            $newUser->setPassword($row[array_search('password', $titlesRow)]);
            $newUser->setTitle($row[array_search('title', $titlesRow)]);
            $newUser->setPicture($row[array_search('picture', $titlesRow)]);

            $entitiesArray[] = $newUser;
        }

        return $entitiesArray;
    }
}
