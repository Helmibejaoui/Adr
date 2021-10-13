<?php


namespace App\Security\Voter;


use App\Entity\User as UserEntity;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;


class User extends Voter
{
    const VIEW = 'view';
    const List = 'list';
    private UserInterface|string $currentUser;


    protected function supports(string $attribute, $subject): bool
    {
        if (!in_array($attribute, [self::List, self::VIEW])) {
            return false;
        }
        if (!$subject instanceof UserEntity) {
            return false;
        }
        return true;
    }

    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token): bool
    {
        $user = $subject;
        $this->currentUser = $token->getUser();

        switch ($attribute) {
            case self::List:
                return $this->canList();
            case self::VIEW:
                return $this->canView($user);
        }
        throw new \LogicException('This code should not be reached!');
    }


    private function canList(): bool
    {
        return false;

    }

    private function canView(UserEntity $user): bool
    {
        return $this->currentUser->getId() === $user->getId();
    }

}