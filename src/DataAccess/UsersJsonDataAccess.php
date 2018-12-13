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

            $newUser->populateEntity(
                $id,
                $userJson['login'],
                $userJson['password'],
                $userJson['title'],
                $userJson['lastname'],
                $userJson['firstname'],
                $userJson['gender'],
                $userJson['email'],
                $userJson['picture'],
                $userJson['address']
            );

            $entitiesArray[] = $newUser;
        }

        return $entitiesArray;
    }
}
