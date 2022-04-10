<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product
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
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="ChildrenProduct")
     */
    private $Parent;

    /**
     * @ORM\OneToMany(targetEntity=Comment::class, mappedBy="Product")
     */
    private $comments;

    /**
     * @ORM\OneToMany(targetEntity=ProductToOrder::class, mappedBy="ParentProducts")
     */
    private $Products;

//    /**
//     * @ORM\OneToMany(targetEntity=ProductImage::class, mappedBy="product")
//     */
//    private $productImages;
    /**
     * @ORM\OneToOne(targetEntity=SonataMediaMedia::class, cascade={"persist", "remove"})
     */
    private $image;

    /**
     * @ORM\OneToOne(targetEntity=SonataMediaGallery::class, cascade={"persist", "remove"})
     */
    private $gallery;

//    /**
//     * @ORM\OneToMany(targetEntity="Application\Sonata\MediaBundle\Entity\SonataMediaMedia", mappedBy="Product")
//     */
//    private $Media;

    public function __toString()
    {
        return $this->name ?? '-';
    }
    public function __construct()
    {
        $this->comments = new ArrayCollection();
        $this->Products = new ArrayCollection();
        $this->productImages = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getParent(): ?Category
    {
        return $this->Parent;
    }

    public function setParent(?Category $Parent): self
    {
        $this->Parent = $Parent;

        return $this;
    }

    /**
     * @return Collection<int, Comment>
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComments(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setProduct($this);
        }

        return $this;
    }

    public function removeComments(Comment $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getProduct() === $this) {
                $comment->setProduct(null);
            }
        }

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
     * @return Collection<int, ProductToOrder>
     */
    public function getProducts(): Collection
    {
        return $this->Products;
    }

    public function addProduct(ProductToOrder $product): self
    {
        if (!$this->Products->contains($product)) {
            $this->Products[] = $product;
            $product->setParentProducts($this);
        }

        return $this;
    }

    public function removeProduct(ProductToOrder $product): self
    {
        if ($this->Products->removeElement($product)) {
            // set the owning side to null (unless already changed)
            if ($product->getParentProducts() === $this) {
                $product->setParentProducts(null);
            }
        }

        return $this;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setProduct($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getProduct() === $this) {
                $comment->setProduct(null);
            }
        }

        return $this;
    }

//    public function getProductImagePath(EntityManagerInterface $entityManager): ?string
//    {
//        $imagePath = $entityManager->getRepository("App:ProductImage")->findBy(["product" => $this->getId()],[],1);
//
//        return $imagePath[0]->getFilepath();
//    }
//
//    /**
//     * @return Collection<int, ProductImage>
//     */
//    public function getProductImages(): Collection
//    {
//        return $this->productImages;
//    }
//
//    public function addProductImage(ProductImage $productImage): self
//    {
//        if (!$this->productImages->contains($productImage)) {
//            $this->productImages[] = $productImage;
//            $productImage->setProduct($this);
//        }
//
//        return $this;
//    }
//
//    public function removeProductImage(ProductImage $productImage): self
//    {
//        if ($this->productImages->removeElement($productImage)) {
//            // set the owning side to null (unless already changed)
//            if ($productImage->getProduct() === $this) {
//                $productImage->setProduct(null);
//            }
//        }
//
//        return $this;
//    }


}
