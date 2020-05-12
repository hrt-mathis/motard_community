<?php

namespace App\Entity;

use App\Repository\RidesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RidesRepository::class)
 */
class Rides
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
    private $ridesPlanning;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ridesDate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ridesName;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRidesPlanning(): ?string
    {
        return $this->ridesPlanning;
    }

    public function setRidesPlanning(string $ridesPlanning): self
    {
        $this->ridesPlanning = $ridesPlanning;

        return $this;
    }

    public function getRidesDate(): ?string
    {
        return $this->ridesDate;
    }

    public function setRidesDate(string $ridesDate): self
    {
        $this->ridesDate = $ridesDate;

        return $this;
    }

    public function getRidesName(): ?string
    {
        return $this->ridesName;
    }

    public function setRidesName(string $ridesName): self
    {
        $this->ridesName = $ridesName;

        return $this;
    }
}
