<?php

namespace App\Tests\Manager;

use App\Manager\UserManager;
use PHPUnit\Framework\TestCase;

class UserManagerTest extends TestCase
{
    public function testGetUsers() {
        $userManager = new UserManager();

        $result = $userManager->getUsers();

        $this->assertEquals([], $result);
    }

    public function testGetUser() {
        $userManager = new UserManager();

        $result = $userManager->getUser();

        $this->assertEquals([], $result);
    }
}
