<?php

namespace App\Manager;

use App\DataAccess\UsersCsvDataAccess;
use App\DataAccess\UsersJsonDataAccess;
use App\Entity\AbstractEntity;
use App\Entity\User;
use App\Exception\UserNotFoundException;

class UserManager
{
    /** @var UsersCsvDataAccess */
    private $csvDataAccess;

    /** @var UsersJsonDataAccess */
    private $jsonDataAccess;

    /**
     * UserManager constructor.
     *
     * @param UsersCsvDataAccess $csvDataAccess
     * @param UsersJsonDataAccess $jsonDataAccess
     */
    public function __construct(UsersCsvDataAccess $csvDataAccess, UsersJsonDataAccess $jsonDataAccess)
    {
        $this->csvDataAccess = $csvDataAccess;
        $this->jsonDataAccess = $jsonDataAccess;
    }

    /**
     * @param array $filters
     * @param int $limit
     * @param int $offset
     *
     * @return array
     */
    public function getUsers(array $filters = [], $limit = 10, $offset = 0)
    {
        $users = $this->getUsersFromDataSource($filters, $limit, $offset);
        $usersJson = [];

        /** @var User $user */
        foreach ($users as $user) {
            $usersJson[] = $user->jsonSerializeShort();
        }

        return $usersJson;
    }

    /**
     * @param int $id
     *
     * @return AbstractEntity
     *
     * @throws UserNotFoundException
     */
    public function getUser($id)
    {
        $user = $this->getUserFromDataSource($id);

        return $user;
    }

    private function importUsersFromCsv()
    {
        return $this->csvDataAccess->getEntities();
    }

    private function importUsersFromJson()
    {
        return $this->jsonDataAccess->getEntities();
    }

    private function getUsersFromDataSource(array $filters = [], $limit = 10, $offset = 0)
    {
        $users = $this->importUsersFromJson();

        $usersFiltered = [];

        if ($filters) {
            /** @var User $user */
            foreach ($users as $user) {
                $userJson = $user->jsonSerialize();

                foreach ($filters as $filterName => $filterValue) {
                    if (strstr($userJson[$filterName], $filterValue)) {
                        $usersFiltered[] = $user;
                    }
                }
            }
        } else {
            $usersFiltered = $users;
        }

        return array_slice($usersFiltered, $offset, $limit);
    }

    /**
     * @param int $userId
     *
     * @return AbstractEntity
     *
     * @throws UserNotFoundException
     */
    private function getUserFromDataSource($userId)
    {
        return $this->jsonDataAccess->getEntityById($userId);
    }
}
