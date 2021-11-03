<?php


namespace App\Controller\Authentication;


use App\Service\User\GetService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Routing\Annotation\Route;

class CurrentUserController
{
    /**
     * @Route("/api/current-user", name="api_current_user", methods={"GET"})
     * @param Security $security
     * @param GetService $getService
     * @return JsonResponse
     */
    public function __invoke(Security $security,GetService $getService): JsonResponse
    {
        return new JsonResponse($getService->getData($security->getUser()));
    }
}