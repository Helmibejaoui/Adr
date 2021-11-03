<?php


namespace App\Manager;


use App\Entity\Blog;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\Persistence\ObjectRepository;
use Symfony\Component\Security\Core\Security;

class BlogManager
{

    private EntityManagerInterface $entityManager;
    private Security $security;
    private ObjectRepository|EntityRepository $repository;

    public function __construct(
        EntityManagerInterface $entityManager,
        Security               $security)
    {
        $this->entityManager = $entityManager;
        $this->security = $security;
        $this->repository = $entityManager->getRepository(Blog::class);
    }

    public function getData(): array
    {
        return $this->repository->findByUserConnected($this->security->getUser());
    }

    public function post(Blog $blog): Blog
    {
        /**
         * @var $user User
         */
        $user = $this->security->getUser();
        $blog->setCreatedBy($user);
        $blog->setCreatedAt(new \DateTime());
        $this->entityManager->persist($blog);
        $this->entityManager->flush();

        return $blog;
    }

}