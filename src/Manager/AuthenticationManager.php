<?php


namespace App\Manager;


use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AuthenticationManager
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private UserPasswordEncoderInterface $encoder;
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $entityManager;

    public function __construct(UserPasswordEncoderInterface $encoder, EntityManagerInterface $entityManager)
    {
        $this->encoder = $encoder;
        $this->entityManager = $entityManager;
    }

    /**
     * @param User $user
     * @return bool
     */
    public function register(User $user): bool
    {
        $user->setPassword($this->encoder->encodePassword($user, $user->getPassword()));
        $this->entityManager->persist($user);
        $this->entityManager->flush();
        return true;
    }

}