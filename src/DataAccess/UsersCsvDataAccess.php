<?php

namespace App\DataAccess;

use App\Entity\User;

class UsersCsvDataAccess extends AbstractDataAccess
{
    protected $fileName = 'testtakers.csv';

    /**
     * @param string $content
     *
     * @return array
     */
    public function serializeContent($content)
    {
        $entitiesArray = [];
        $contentArray =  str_getcsv($content, "\n");

        array_shift($contentArray);

        foreach ($contentArray as $userString) {
            $row = str_getcsv($userString, ",");

            $newUser = new User();

            $newUser->setAddress($row[8]);
            $newUser->setEmail($row[6]);
            $newUser->setFirstName($row[4]);
            $newUser->setLastName($row[3]);
            $newUser->setGender($row[5]);
            $newUser->setLogin($row[0]);
            $newUser->setPassword($row[1]);
            $newUser->setTitle($row[2]);
            $newUser->setPicture($row[7]);

            $entitiesArray[] = $newUser;
        }

        return $entitiesArray;
    }
}
