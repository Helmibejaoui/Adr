<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private ?int $id;
    /**
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=25, unique=true)
     */
    private string $username;
    /**
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=255)
     */
    private ?string $password;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=45)
     */
    private $email;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=25, unique=false)
     */
    private string $firstname;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=25, unique=false)
     */
    private string $lastname;

    /**
     * User constructor.
     * @param $username
     */
    public function __construct($username)
    {
        $this->username = $username;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername(mixed $username): void
    {
        $this->username = $username;
    }

    /**
     * @return string|null
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getEmail(): mixed
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail(mixed $email): void
    {
        $this->email = $email;
    }

    /**
     * @return array
     */
    public function getRoles(): array
    {
        return array('ROLE_USER');
    }

    public function eraseCredentials()
    {
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }


}