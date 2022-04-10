<?php

namespace App\Controller;


use App\Entity\Category;
use App\Entity\Comment;
use App\Entity\Product;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/product/{id}", name="product")
     */
    public function productShow(EntityManagerInterface $entityManager, Request $request, ProductRepository $product_repository, ManagerRegistry $doctrine): Response
    {

        $productId = $request->attributes->get('id');
        $product = $product_repository->find(['id'=>$productId]);
//        $product = $entityManager->getRepository("App:Product")->findBy(['id' => $productId]);
        $description = $entityManager->getRepository("App:Product")->findBy(['id' => $productId]);
        $comment_repository = $doctrine->getRepository(Comment::class)->findAll();
        $category_repository = $doctrine->getRepository(Category::class);
        $gallery = $product->getGallery()->getGalleryHasMedias();
        $additional_images = [];
        foreach($gallery as $g)
        {
            $additional_images[] = $g->getMedia();
        }

        return $this->render('product/product.html.twig', [
            'product' => $product,
            'productId' => $productId,
            'description' => $description[0],
            'additional_images' => $additional_images,
            'comments'=>$comment_repository,
        ]);
    }
    public function productRatingShort(Product $product, ManagerRegistry $doctrine): Response
    {
        $product_repository = $doctrine->getRepository(Product::class);

        $avg_rating = $product_repository->getAvgRating($product);

        return $this->render('default/rate_star.html..twig', [
            'rating' => floor($avg_rating)
        ]);
    }


}

         

    
