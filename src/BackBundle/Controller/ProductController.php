<?php

namespace BackBundle\Controller;

use BackBundle\Entity\Product;
use BackBundle\Form\ProductType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    /**
     * @Route("/product/list")
     */
    public function listAction(): Response
    {
        $products = $this->getDoctrine()->getRepository(Product::class)->findAll();

        return $this->render('@Back/product/list.html.twig', ['products' => $products]);
    }

    /**
     * @Route("/product/add")
     */
    public function addAction(): Response
    {
//        $product = new Product();
        $product = $this->getDoctrine()->getRepository('BackBundle:Product')->findAll()[0];
        $form = $this->createForm(ProductType::class, $product);

        return $this->render('@Back/product/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
