<?php


namespace App\Controller\User;


use App\Service\User\ListService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ListController
{
    /**
     * Get user
     * @Route("/api/users/", name="api_user_list", methods={"GET"})
     * @param ListService $listService
     * @return JsonResponse
     */
    public function __invoke(ListService $listService): JsonResponse
    {
        return new JsonResponse($listService->getData());
    }
}