<?php


namespace App\Manager;


use App\Entity\User;
use App\Repository\UserRepository;

class UserManager
{
    /**
     * @var UserRepository
     */
    private UserRepository $repository;

    public function __construct(UserRepository $userRepository)
    {
        $this->repository = $userRepository;
    }

    public function getData(): array
    {
        return $this->repository->findUsers();
    }

    public function getUser(User $user): array
    {
        return [
            'id' => $user->getId(),
            'email' => $user->getEmail(),
            'username' => $user->getUsername(),
            'lastname' => $user->getLastname(),
            'firstname' => $user->getFirstname(),
        ];
    }
}