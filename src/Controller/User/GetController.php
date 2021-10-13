<?php


namespace App\Controller\User;


use App\Entity\User;
use App\Service\User\GetService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


class GetController
{
    /**
     * Get user
     * @Route("/api/users/{id}", name="api_user_get", methods={"GET"},options={"expose": true})
     * @ParamConverter("user", options={"id": "id"})
     * @IsGranted("view", subject="user", statusCode=404, message="Acess denied You are not authorized to acess this page.")
     * @param GetService $getService
     * @param User $user
     * @return JsonResponse
     */
    public function __invoke(GetService $getService, User $user): JsonResponse
    {
        return new JsonResponse($getService->getData($user));
    }
}