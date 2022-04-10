<?php
namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController {
    /**
     * @throws \Exception
     */
    /**
     * @Route("/{name}", name="category")
     */
    public function categoryShow(EntityManagerInterface $entityManager, Request $request): Response
    {
        $categories = $entityManager->getRepository("App:Category")->findAll();
        $categoryName = $request->attributes->get('name');
        $category = $entityManager->getRepository("App:Category")->findBy(['name' => $categoryName]);
        $products = $entityManager->getRepository("App:Product")->findAll();
        $productId = $request->attributes->get('id');
        $product = $entityManager->getRepository("App:Product")->findBy(['id' => $productId]);
//        $gallery = $category->getGallery()->getGalleryHasMedias();
//        $additional_images = [];
//        foreach($gallery as $g)
//        {
//            $additional_images = $g->getMedia();
//        }
        return $this->render('category/category.html.twig', [
            'category' => $category[0],
            'category.name' => $categoryName,
            'categories' =>$categories,
//            'product' => $product,
            'productId' => $productId,
            'products'=>$products,
//            'additional_images' => $additional_images,

        ]);




    }


    public function categoryList (EntityManagerInterface $entityManager, Request $request): Response
    {
        $categories = $entityManager->getRepository("App:Category")->findAll();

        return $this->render('layout/category.html.twig', [
            'categories' => $categories,
        ]);

    }


}