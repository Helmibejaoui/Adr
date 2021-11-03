<?php


namespace App\Manager;


use App\Entity\Blog;
use App\Entity\User;
use App\Repository\BlogRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;

class BlogManager
{

    private EntityManagerInterface $entityManager;
    private Security $security;

    public function __construct(
        EntityManagerInterface $entityManager,
        Security               $security)
    {
        $this->entityManager = $entityManager;
        $this->security = $security;
    }

    public function post(Blog $blog): Blog
    {
        /**
         * @var $user User
         */
        $user = $this->security->getUser();
        $blog->setCreatedBy($user);
        $this->entityManager->persist($blog);
        $this->entityManager->flush();

        return $blog;
    }

}