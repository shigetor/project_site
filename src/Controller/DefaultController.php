<?php

namespace App\Controller;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use App\Entity\Product;
use App\Entity\Comment;
use App\Entity\Category;




class DefaultController extends AbstractController
{

    /**
     * @throws \Exception
     */




    public function topNavigation(ManagerRegistry $doctrine): Response
    {
        $category_repository = $doctrine->getRepository(Category::class);

        $categories = $category_repository->findBy(['Parent' => null]);

        return $this->render('layout/carusel.twig', [
            'categories' => $categories,
        ]);
    }
    public function product(): Response
    {
        return $this->render('product/product.html.twig');
    }



}
