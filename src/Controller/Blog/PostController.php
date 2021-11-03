<?php

namespace App\Controller\Blog;

use App\Entity\Blog;
use App\Form\BlogType;
use App\Service\Blog\PostService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    /**
     * @Route("/api/blogs", name="api_blog_new", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request, PostService $postService): JsonResponse
    {

        $form = $this->createForm(
            BlogType::class, new Blog(),
            [
                'csrf_protection' => false,
            ]);
        $form->submit(json_decode($request->getContent(), true));
        $form->handleRequest($request);
        $form->isValid();
        if (
            $form->isSubmitted() && (!$form->getErrors() ||
                (
                    $form->getErrors() &&
                    0 === $form->getErrors()->count()))) {
            $result = $postService->post($form->getData());
            if (isset($result['success'])) {
                return new JsonResponse(['status' => 'ok', 'code' => Response::HTTP_CREATED, 'data' => $result], Response::HTTP_CREATED);
            }

            return new JsonResponse(['status' => 'ko', 'code' => Response::HTTP_UNPROCESSABLE_ENTITY, 'data' => $result], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return new JsonResponse(['status' => 'ko', 'code' => Response::HTTP_UNPROCESSABLE_ENTITY, 'data' => $form->getErrors()], Response::HTTP_UNPROCESSABLE_ENTITY);

    }
}