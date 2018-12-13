<?php

namespace App\Tests\Controller;

use App\Controller\UserController;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{
    /**
     * @covers UserController::getUsersAction()
     */
    public function testGetUsers()
    {
        $_SERVER['DOCUMENT_ROOT'] = './public';
        $client = static::createClient();

        $client->request('GET', '/api/v1/users');

        $this->assertTrue(
            $client->getResponse()->headers->contains(
                'Content-Type',
                'application/json'
            )
        );

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $response = $client->getResponse()->getContent();

        $responseArray = json_decode($response, true);

        foreach ($responseArray as $user) {
            $this->assertGreaterThan(-1, $user['id']);
            $this->assertNotEmpty($user['firstname']);
            $this->assertNotEmpty($user['lastname']);
            $this->assertNotEmpty($user['email']);
            $this->assertNotEmpty($user['password']);
            $this->assertNotEmpty($user['gender']);
            $this->assertNotEmpty($user['address']);
            $this->assertNotEmpty($user['picture']);
            $this->assertNotEmpty($user['title']);
        }

        $this->assertEquals(10, count($responseArray));
    }

    /**
     * @covers UserController::getUsersAction()
     */
    public function testGetUsersLimit()
    {
        $_SERVER['DOCUMENT_ROOT'] = './public';
        $client = static::createClient();

        $client->request('GET', '/api/v1/users?limit=5');

        $this->assertTrue(
            $client->getResponse()->headers->contains(
                'Content-Type',
                'application/json'
            )
        );

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $response = $client->getResponse()->getContent();

        $responseArray = json_decode($response, true);

        foreach ($responseArray as $user) {
            $this->assertGreaterThan(-1, $user['id']);
            $this->assertNotEmpty($user['firstname']);
            $this->assertNotEmpty($user['lastname']);
            $this->assertNotEmpty($user['email']);
            $this->assertNotEmpty($user['password']);
            $this->assertNotEmpty($user['gender']);
            $this->assertNotEmpty($user['address']);
            $this->assertNotEmpty($user['picture']);
            $this->assertNotEmpty($user['title']);
        }

        $this->assertEquals(5, count($responseArray));
    }
}
