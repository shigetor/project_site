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
class MainController extends AbstractController
{
    /**
     * @throws Exception
     */
    /**
     * @Route("/index", name="index")
     */
    public function index(ManagerRegistry $doctrine): Response
    {
        $categories = $doctrine->getRepository(Category::class)->findBy(['Parent'=>null]);

        return $this->render('default/index.html.twig', [
            'categories' => $categories,
        ]);
    }
}
