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
        $contentArray = str_getcsv($content, "\n");

        $titlesRow = str_getcsv(array_shift($contentArray), ",");

        foreach ($contentArray as $id => $userString) {
            $row = str_getcsv($userString, ",");

            $newUser = new User();

            $newUser->populateEntity(
                $id,
                $row[array_search('login', $titlesRow)],
                $row[array_search('password', $titlesRow)],
                $row[array_search('title', $titlesRow)],
                $row[array_search('lastname', $titlesRow)],
                $row[array_search('firstname', $titlesRow)],
                $row[array_search('gender', $titlesRow)],
                $row[array_search('email', $titlesRow)],
                $row[array_search('picture', $titlesRow)],
                $row[array_search('address', $titlesRow)]
            );

            $entitiesArray[] = $newUser;
        }

        return $entitiesArray;
    }
}
