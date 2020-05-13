<?php

namespace App\Entity;

use App\Repository\LocationRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;


/**
 * @ORM\Entity(repositoryClass=LocationRepository::class)
 */
class Location
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
    private $locationName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $locationItinerary;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $locationPoint;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $locationDistance;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $locationCountry;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLocationName(): ?string
    {
        return $this->locationName;
    }

    public function setLocationName(string $locationName): self
    {
        $this->locationName = $locationName;

        return $this;
    }

    public function getLocationItinerary(): ?string
    {
        return $this->locationItinerary;
    }

    public function setLocationItinerary(string $locationItinerary): self
    {
        $this->locationItinerary = $locationItinerary;

        return $this;
    }

    public function getLocationPoint(): ?string
    {
        return $this->locationPoint;
    }

    public function setLocationPoint(string $locationPoint): self
    {
        $this->locationPoint = $locationPoint;

        return $this;
    }

    public function getLocationDistance(): ?string
    {
        return $this->locationDistance;
    }

    public function setLocationDistance(string $locationDistance): self
    {
        $this->locationDistance = $locationDistance;

        return $this;
    }

    public function getLocationCountry(): ?string
    {
        return $this->locationCountry;
    }

    public function setLocationCountry(string $locationCountry): self
    {
        $this->locationCountry = $locationCountry;

        return $this;
    }
}
