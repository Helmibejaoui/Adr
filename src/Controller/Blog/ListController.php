<?php

namespace App\Controller\Blog;

use App\Service\Blog\ListService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Routing\Annotation\Route;

class ListController
{
    /**
     * @Route("/api/blogs", name="api_blog_list", methods={"GET"})
     * @param ListService $listService
     * @return JsonResponse
     */
    public function __invoke(ListService $listService): JsonResponse
    {
        return new JsonResponse($listService->getData());
    }
}