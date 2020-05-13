<?php

namespace App\Entity;

use App\Repository\EventRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * @ORM\Entity(repositoryClass=EventRepository::class)
 */
class Event
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
    private $eventDate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $eventName;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEventDate(): ?string
    {
        return $this->eventDate;
    }

    public function setEventDate(string $eventDate): self
    {
        $this->eventDate = $eventDate;

        return $this;
    }

    public function getEventName(): ?string
    {
        return $this->eventName;
    }

    public function setEventName(string $eventName): self
    {
        $this->eventName = $eventName;

        return $this;
    }
}
