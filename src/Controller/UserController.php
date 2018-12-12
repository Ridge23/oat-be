<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends AbstractController
{
    /** @var int */
    private $defaultResponseCode = Response::HTTP_OK;

    public function getUsersAction()
    {
        $statusCode = $this->defaultResponseCode;

        return new JsonResponse([], $statusCode);
    }

    public function getUserAction()
    {
        $statusCode = $this->defaultResponseCode;

        return new JsonResponse([], $statusCode);
    }
}
