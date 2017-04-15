<?php

namespace BackBundle\Controller;

use BackBundle\Entity\Product;
use BackBundle\Form\ProductType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    /**
     * @Route(
     *     "/product/list",
     *     name="product_list"
     * )
     */
    public function listAction(): Response
    {
        $products = $this->getDoctrine()->getRepository(Product::class)->findAll();

        return $this->render('@Back/product/list.html.twig', ['products' => $products]);
    }

    /**
     * @Route(
     *     "/product/add",
     *     name="product_add"
     * )
     * @param Request $request
     * @return Response
     */
    public function addAction(Request $request): Response
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $product = $form->getData();
            $this->persistProduct($product);
            return $this->redirectToRoute('product_list');
        }

        return $this->render('@Back/product/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route(
     *     "/product/{id}/edit",
     *     name="product_edit",
     *     requirements={"id"="\d+"}
     * )
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function editAction(Request $request, int $id): Response
    {
        $product = $this->getDoctrine()->getRepository('BackBundle:Product')->find($id);
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $product = $form->getData();
            $this->persistProduct($product);
            return $this->redirectToRoute('product_list');
        }

        return $this->render('@Back/product/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    private function persistProduct(Product $product)
    {
        $em = $this->getDoctrine()->getManager();
        $em->persist($product);
        $em->flush();
    }
}
