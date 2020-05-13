<?php

namespace App\Entity;

use App\Repository\CartRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * @ORM\Entity(repositoryClass=CartRepository::class)
 */
class Cart
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
    private $cartQuantity;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cartPrice;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCartQuantity(): ?string
    {
        return $this->cartQuantity;
    }

    public function setCartQuantity(string $cartQuantity): self
    {
        $this->cartQuantity = $cartQuantity;

        return $this;
    }

    public function getCartPrice(): ?string
    {
        return $this->cartPrice;
    }

    public function setCartPrice(string $cartPrice): self
    {
        $this->cartPrice = $cartPrice;

        return $this;
    }
}
