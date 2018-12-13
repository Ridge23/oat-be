<?php

namespace App\Manager;


use App\DataAccess\UsersCsvDataAccess;
use App\DataAccess\UsersJsonDataAccess;

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

    public function getUsers($filter = '', $limit = 10, $offset = 0)
    {
        return $this->getUsersFromDataSource($filter, $limit, $offset);
    }

    public function getUser()
    {
        $users = $this->importUsersFromCsv();

        return [];
    }

    private function importUsersFromCsv()
    {
        return $this->csvDataAccess->getEntities();
    }

    private function importUsersFromJson()
    {
        return $this->jsonDataAccess->getEntities();
    }

    private function getUsersFromDataSource($filter, $limit = 10, $offset = 0)
    {
        $users = $this->importUsersFromJson();

        return array_slice($users, $offset, $limit);
    }
}
