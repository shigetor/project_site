<?php

namespace App\Entity;

use App\Repository\ProductImageRepository;
use Doctrine\ORM\Mapping as ORM;
use function GuzzleHttp\Psr7\str;

/**
 * @ORM\Entity(repositoryClass=ProductImageRepository::class)
 */
class ProductImage
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Product::class, inversedBy="productImages")
     */
    private $product;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $file_path;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }

    public function getFilePath(): ?string
    {
        return $this->file_path;
    }

    public function setFilePath(string $file_path): self
    {
        $this->file_path = $file_path;

        return $this;
    }
    public function __toString(){
        return $this->file_path ??'-';
    }
}
