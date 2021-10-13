<?php


namespace App\Service\User;


use App\Entity\User;
use App\Manager\UserManager;

class GetService
{
    private UserManager $manager;

    public function __construct(UserManager $userManager)
    {
        $this->manager = $userManager;
    }

    public function getData(User $user): array
    {
        return $this->manager->getUser($user);
    }
}