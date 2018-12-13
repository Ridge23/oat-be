<?php

namespace App\Tests\Controller;

use App\Controller\UserController;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Bundle\FrameworkBundle\Client;

class UserControllerTest extends WebTestCase
{
    /** @var Client  */
    private $client;

    /**
     * UserControllerTest constructor.
     * @param string|null $name
     * @param array $data
     * @param string $dataName
     */
    public function __construct(string $name = null, array $data = [], string $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $_SERVER['DOCUMENT_ROOT'] = './public';

        $this->client = static::createClient();
    }

    /**
     * @covers UserController::getUsersAction()
     */
    public function testGetUsers()
    {
        $this->client->request('GET', '/api/v1/users');

        $this->assertTrue(
            $this->client->getResponse()->headers->contains(
                'Content-Type',
                'application/json'
            )
        );

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $response = $this->client->getResponse()->getContent();

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
        $this->client->request('GET', '/api/v1/users?limit=5');

        $this->assertTrue(
            $this->client->getResponse()->headers->contains(
                'Content-Type',
                'application/json'
            )
        );

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $response = $this->client->getResponse()->getContent();

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

    /**
     * @covers UserController::getUsersAction()
     */
    public function testGetUsersFilter()
    {
        $this->client->request('GET', '/api/v1/users?lastname=foster');

        $this->assertTrue(
            $this->client->getResponse()->headers->contains(
                'Content-Type',
                'application/json'
            )
        );

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $response = $this->client->getResponse()->getContent();

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

            $this->assertContains('foster', $user['lastname']);
        }
    }

    /**
     * @covers UserController::getUserAction()
     */
    public function testGetUser() {
        $this->client->request('GET', '/api/v1/users/10');

        $this->assertTrue(
            $this->client->getResponse()->headers->contains(
                'Content-Type',
                'application/json'
            )
        );

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $response = $this->client->getResponse()->getContent();
        $user = json_decode($response, true);

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
}
