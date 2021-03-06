<?php

namespace App\Controller;

use Exception;
use App\Manager\UserManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends AbstractController
{
    /** @var int */
    private $defaultResponseCode = Response::HTTP_OK;

    /** @var UserManager */
    private $userManager;

    /**
     * UserController constructor.
     *
     * @param UserManager $userManager
     */
    public function __construct(UserManager $userManager)
    {
        $this->userManager = $userManager;
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function getUsersAction(Request $request)
    {
        $statusCode = $this->defaultResponseCode;

        try {
            $limit = (int)$request->query->get('limit', 10);
            $offset = (int)$request->query->get('offset', 0);

            $queryParams = $request->query->all();
            unset($queryParams['limit']);
            unset($queryParams['offset']);

            $result = $this->userManager->getUsers($queryParams, $limit, $offset);
        } catch (Exception $exception) {
            $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR;
            $result = $exception->getMessage();
        }

        return new JsonResponse($result, $statusCode);
    }

    /**
     * @param int $userId
     *
     * @return JsonResponse
     */
    public function getUserAction($userId = 0)
    {
        $statusCode = $this->defaultResponseCode;
        try {
            $result = $this->userManager->getUser($userId);

        } catch (Exception $exception) {
            $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR;
            $result = $exception->getMessage();
        }


        return new JsonResponse($result, $statusCode);
    }
}
