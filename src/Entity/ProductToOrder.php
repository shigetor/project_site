<?php

namespace App\Entity;

use App\Repository\ProductToOrdersRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductToOrdersRepository::class)
 */
class ProductToOrder
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $price;

    /**
     * @ORM\ManyToOne(targetEntity=Product::class, inversedBy="Products")
     */
    private $ParentProducts;

    /**
     * @ORM\ManyToOne(targetEntity=Order::class, inversedBy="Order")
     */
    private $ParentOrders;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function __toString()
    {
        return $this->name ?? '-';
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getParentProducts(): ?Product
    {
        return $this->ParentProducts;
    }

    public function setParentProducts(?Product $ParentProducts): self
    {
        $this->ParentProducts = $ParentProducts;

        return $this;
    }

    public function getParentOrders(): ?Order
    {
        return $this->ParentOrders;
    }

    public function setParentOrders(?Order $ParentOrders): self
    {
        $this->ParentOrders = $ParentOrders;

        return $this;
    }


}
