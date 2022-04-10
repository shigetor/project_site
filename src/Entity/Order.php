<?php

namespace App\Entity;

use App\Repository\OrdersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Table (name="order_or")
 * @ORM\Entity(repositoryClass=OrdersRepository::class)
 */
class Order
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $price;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantity;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nameClient;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @Gedmo\Timestampable (on = "create")
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @ORM\OneToMany(targetEntity=ProductToOrder::class, mappedBy="ParentOrders")
     */
    private $Orders;

    public function __construct()
    {
        $this->Orders = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getNameClient(): ?string
    {
        return $this->nameClient;
    }

    public function setNameClient(string $nameClient): self
    {
        $this->nameClient = $nameClient;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created;
    }

    public function setCreated(\DateTimeInterface $created): self
    {
        $this->created = $created;

        return $this;
    }

    /**
     * @return Collection<int, ProductToOrder>
     */
    public function getOrders(): Collection
    {
        return $this->Orders;
    }

    public function addOrder(ProductToOrder $order): self
    {
        if (!$this->Orders->contains($order)) {
            $this->Orders[] = $order;
            $order->setParentOrders($this);
        }

        return $this;
    }

    public function removeOrder(ProductToOrder $order): self
    {
        if ($this->Orders->removeElement($order)) {
            // set the owning side to null (unless already changed)
            if ($order->getParentOrders() === $this) {
                $order->setParentOrders(null);
            }
        }

        return $this;
    }
}
