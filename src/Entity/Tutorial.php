<?php

namespace App\Entity;

use App\Repository\TutorialRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * @ORM\Entity(repositoryClass=TutorialRepository::class)
 */
class Tutorial
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
    private $tutorialName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $tutorialDate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $tutorialUser;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTutorialName(): ?string
    {
        return $this->tutorialName;
    }

    public function setTutorialName(string $tutorialName): self
    {
        $this->tutorialName = $tutorialName;

        return $this;
    }

    public function getTutorialDate(): ?string
    {
        return $this->tutorialDate;
    }

    public function setTutorialDate(string $tutorialDate): self
    {
        $this->tutorialDate = $tutorialDate;

        return $this;
    }

    public function getTutorialUser(): ?string
    {
        return $this->tutorialUser;
    }

    public function setTutorialUser(string $tutorialUser): self
    {
        $this->tutorialUser = $tutorialUser;

        return $this;
    }
}
