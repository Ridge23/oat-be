<?php

namespace App\Tests\Manager;

use App\DataAccess\UsersCsvDataAccess;
use App\DataAccess\UsersJsonDataAccess;
use App\Entity\User;
use App\Manager\UserManager;
use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_MockObject_MockObject;

class UserManagerTest extends TestCase
{
    /**
     * @covers UserManager::getUsers()
     */
    public function testGetUsers()
    {
        /** @var UsersCsvDataAccess|PHPUnit_Framework_MockObject_MockObject $csvDataSourceMock */
        $csvDataSourceMock = $this->getMockBuilder(UsersCsvDataAccess::class)->disableOriginalConstructor()->getMock();
        /** @var UsersJsonDataAccess|PHPUnit_Framework_MockObject_MockObject $jsonDataSourceMock */
        $jsonDataSourceMock = $this->getMockBuilder(UsersJsonDataAccess::class)->disableOriginalConstructor()->getMock();

        $userOne = new User();
        $userOne->setId(0);
        $userOne->setPicture('some-picture');
        $userOne->setTitle('mr');
        $userOne->setLogin('pavel');
        $userOne->setPassword('some-password');
        $userOne->setGender('male');
        $userOne->setFirstName('pavel');
        $userOne->setLastName('khrebto');
        $userOne->setEmail('pavel.khrebto@gmail.com');

        $userTwo = new User();
        $userTwo->setId(0);
        $userTwo->setPicture('some-picture');
        $userTwo->setTitle('mrs');
        $userTwo->setLogin('agness');
        $userTwo->setPassword('some-password');
        $userTwo->setGender('female');
        $userTwo->setFirstName('agness');
        $userTwo->setLastName('orakyan');
        $userTwo->setEmail('agness.orakyan@gmail.com');

        $jsonDataSourceMock->expects($this->exactly(1))->method('getEntities')->willReturn(
            [
                $userOne, $userTwo
            ]
        );
        $userManager = new UserManager($csvDataSourceMock, $jsonDataSourceMock);

        $result = $userManager->getUsers();

        $this->assertEquals([
            'data' => [
                [
                    'id' => 0,
                    'firstname' => 'pavel',
                    'lastname' => 'khrebto'
                ],
                [
                    'id' => 0,
                    'firstname' => 'agness',
                    'lastname' => 'orakyan'
                ]
            ],
            'total' => 2
        ], $result);
    }

    /**
     * @covers UserManager::getUser()
     */
    public function testGetUser()
    {
        /** @var UsersCsvDataAccess|PHPUnit_Framework_MockObject_MockObject $csvDataSourceMock */
        $csvDataSourceMock = $this->getMockBuilder(UsersCsvDataAccess::class)->disableOriginalConstructor()->getMock();
        /** @var UsersJsonDataAccess|PHPUnit_Framework_MockObject_MockObject $jsonDataSourceMock */
        $jsonDataSourceMock = $this->getMockBuilder(UsersJsonDataAccess::class)->disableOriginalConstructor()->getMock();

        $userManager = new UserManager($csvDataSourceMock, $jsonDataSourceMock);

        $userOne = new User();
        $userOne->setId(0);
        $userOne->setPicture('some-picture');
        $userOne->setTitle('mr');
        $userOne->setLogin('pavel');
        $userOne->setPassword('some-password');
        $userOne->setGender('male');
        $userOne->setFirstName('pavel');
        $userOne->setLastName('khrebto');
        $userOne->setEmail('pavel.khrebto@gmail.com');

        $jsonDataSourceMock->expects($this->once())->method('getEntityById')->with(10)->willReturn(
            $userOne
        );

        $result = $userManager->getUser(10);

        $this->assertEquals($userOne, $result);
    }
}
