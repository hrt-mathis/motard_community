<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $userName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $userAge;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $userDescription;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserName(): ?string
    {
        return $this->userName;
    }

    public function setUserName(string $userName): self
    {
        $this->userName = $userName;

        return $this;
    }

    public function getUserAge(): ?string
    {
        return $this->userAge;
    }

    public function setUserAge(string $userAge): self
    {
        $this->userAge = $userAge;

        return $this;
    }

    public function getUserDescription(): ?string
    {
        return $this->userDescription;
    }

    public function setUserDescription(string $userDescription): self
    {
        $this->userDescription = $userDescription;

        return $this;
    }
}
