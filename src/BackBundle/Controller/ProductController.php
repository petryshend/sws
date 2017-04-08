<?php

namespace BackBundle\Controller;

use BackBundle\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ProductController extends Controller
{
    /**
     * @Route("/")
     */
    public function listAction()
    {
        $products = $this->getDoctrine()->getRepository(Product::class)->findAll();

        return $this->render('@Back/index.html.twig', ['products' => $products]);
    }
}
