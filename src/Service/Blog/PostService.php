<?php

namespace App\Service\Blog;

use App\Manager\BlogManager;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Exception;
use Symfony\Contracts\Translation\TranslatorInterface;

class PostService
{
    private ValidatorInterface $validator;
    private TranslatorInterface $translator;
    private BlogManager $manager;

    public function __construct(
        ValidatorInterface  $validator,
        TranslatorInterface $translator,
        BlogManager         $manager)
    {
        $this->validator = $validator;
        $this->translator = $translator;
        $this->manager = $manager;
    }

    /**
     * @param $blog
     * @return array
     * @throws Exception
     */
    public function post($blog): array
    {
        /**
         * @var $constraintViolationList ConstraintViolationList
         */
        $constraintViolationList = $this->validator->validate($blog);
        if (empty($constraintViolationList) || empty($constraintViolationList->count())) {
            $blog = $this->manager->post($blog);
        } else {
            $errors = [];
           foreach ($constraintViolationList->getIterator() as $constraintViolation) {


                $message = $this->translator->trans($constraintViolation->getMessageTemplate(), [], 'validators', 'en');

                $errors[$constraintViolation->getPropertyPath()] = $message;
            }
        }

        return $errors ?? ['success' => true, 'blogId' => $blog->getId()];
    }
}