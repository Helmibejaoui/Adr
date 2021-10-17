<?php


namespace App\Controller\Common;


use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;


class MenuController
{
    /**
     * Get menu
     * @Route("/api/menu", name="api_menu_get", methods={"GET"},options={"expose": true})
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        $menu = [
            ['path' => "/", 'alias' => "Home"],
            ['path' => "/profile", 'alias' => "Profile"]
        ];
        return new JsonResponse($menu);
    }
}