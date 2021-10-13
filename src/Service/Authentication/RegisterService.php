<?php


namespace App\Service\Authentication;


use App\Entity\User;
use App\Manager\AuthenticationManager;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Exception;

class RegisterService
{
    /**
     * @var AuthenticationManager
     */
    private AuthenticationManager $authenticationManager;
    /**
     * @var ValidatorInterface
     */
    private ValidatorInterface $validator;


    public function __construct(AuthenticationManager $authenticationManager, ValidatorInterface $validator)
    {
        $this->authenticationManager = $authenticationManager;
        $this->validator = $validator;
    }

    /**
     * @param User $user
     * @return array|bool
     * @throws Exception
     */
    public function register(User $user): array|bool
    {
        $constraintViolationList = $this->validator->validate($user);
        if (empty($constraintViolationList) || empty($constraintViolationList->count())) {
            return $this->authenticationManager->register($user);
        }
        $errors = [];
        foreach ($constraintViolationList->getIterator() as $constraintViolation) {
            $errors[$constraintViolation->getPropertyPath()] = $constraintViolation->getMessageTemplate();
        }
        return $errors;

    }

}