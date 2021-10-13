<?php


namespace App\Controller\Authentication;


use App\Controller\Common\ApiController;
use App\Entity\User;
use App\Form\UserType;
use App\Service\Authentication\RegisterService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Exception;

class RegisterController extends ApiController
{

    /**
     * @Route("/api/register", name="api_register", methods={"POST"})
     * @param Request $request
     * @param RegisterService $registerService
     * @return JsonResponse
     */
    public function __invoke(Request $request, RegisterService $registerService): JsonResponse
    {
        $request = $this->transformJsonBody($request);
        $form = $this->createForm(
            UserType::class, new User($request->request->get('username')),
            ['csrf_protection' => false,]
        );
        $form->submit($request->request->all());
        $form->handleRequest($request);
        $form->isValid();
        if ($form->isSubmitted() &&
            (!$form->getErrors() || $form->getErrors() && $form->getErrors()->count() === 0)) {
            try {
                $result = $registerService->register($form->getData());
            } catch (Exception $e) {
                return $this->respondValidationError('Username exists');
            }
            if ($result !== true) {
                return $this->respondValidationError($result);

            }
            return $this->respondWithSuccess(sprintf('User successfully created'));
        }

        return $this->respondValidationError($form->getErrors());

    }
}