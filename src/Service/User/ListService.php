<?php


namespace App\Service\User;


use App\Entity\User;
use App\Manager\UserManager;

class ListService
{
    private UserManager $manager;

    public function __construct(UserManager $userManager)
    {
        $this->manager = $userManager;
    }

    public function getData(): array
    {
        return $this->manager->getData();
    }
}