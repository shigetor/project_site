<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
class Category
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
    private $name;

    /**
     * @Gedmo\Timestampable (on = "create")
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     *  @Gedmo\Timestampable (on = "update")
     * @ORM\Column(type="datetime")
     */
    private $updated;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="Children")
     */
    private $Parent;

    /**
     * @ORM\OneToMany(targetEntity=Category::class, mappedBy="Parent")
     */
    private $Children;

    /**
     * @ORM\Column(type="boolean")
     */
    private $active = true;

    /**
     * @ORM\OneToMany(targetEntity=Product::class, mappedBy="Parent")
     */
    private $ChildrenProduct;
    /**
     * @ORM\OneToOne(targetEntity=SonataMediaMedia::class, cascade={"persist", "remove"})
     */
    private $image;

    /**
     * @ORM\OneToOne(targetEntity=SonataMediaGallery::class, cascade={"persist", "remove"})
     */
    private $gallery;

    public function __toString()
    {
        return $this->name ?? '-';
    }

    public function __construct()
    {
        $this->Children = new ArrayCollection();
        $this->ChildrenProduct = new ArrayCollection();
    }

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

    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created;
    }

    public function setCreated(\DateTimeInterface $created): self
    {
        $this->created = $created;

        return $this;
    }

    public function getUpdated(): ?\DateTimeInterface
    {
        return $this->updated;
    }

    public function setUpdated(\DateTimeInterface $updated): self
    {
        $this->updated = $updated;

        return $this;
    }

    public function getParent(): ?self
    {
        return $this->Parent;
    }

    public function setParent(?self $Parent): self
    {
        $this->Parent = $Parent;

        return $this;
    }
    public function getImage(): ?SonataMediaMedia
    {
        return $this->image;
    }

    public function setImage(?SonataMediaMedia $image): self
    {
        $this->image = $image;

        return $this;
    }
    public function getGallery(): ?SonataMediaGallery
    {
        return $this->gallery;
    }

    public function setGallery(?SonataMediaGallery $gallery): self
    {
        $this->gallery = $gallery;

        return $this;
    }
    /**
     * @return Collection<int, self>
     */
    public function getChildren(): Collection
    {
        return $this->Children;
    }

    public function addChild(self $child): self
    {
        if (!$this->Children->contains($child)) {
            $this->Children[] = $child;
            $child->setParent($this);
        }

        return $this;
    }

    public function removeChild(self $child): self
    {
        if ($this->Children->removeElement($child)) {
            // set the owning side to null (unless already changed)
            if ($child->getParent() === $this) {
                $child->setParent(null);
            }
        }

        return $this;
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    /**
     * @return Collection<int, Product>
     */
    public function getChildrenProduct(): Collection
    {
        return $this->ChildrenProduct;
    }

    public function addChildrenProduct(Product $childrenProduct): self
    {
        if (!$this->ChildrenProduct->contains($childrenProduct)) {
            $this->ChildrenProduct[] = $childrenProduct;
            $childrenProduct->setParent($this);
        }

        return $this;
    }

    public function removeChildrenProduct(Product $childrenProduct): self
    {
        if ($this->ChildrenProduct->removeElement($childrenProduct)) {
            // set the owning side to null (unless already changed)
            if ($childrenProduct->getParent() === $this) {
                $childrenProduct->setParent(null);
            }
        }

        return $this;
    }
}
