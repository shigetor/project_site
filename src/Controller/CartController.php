<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{

    /**
     * @throws \Exception
     */
    /**
     * @Route ("/cart", name = "cart")
     */

    public function cart(): Response
    {
        return $this->render('layout/cart.html.twig');
    }
}
