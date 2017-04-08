<?php

namespace BackBundle\DataFixtures\ORM;

use BackBundle\Entity\Product;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadProducts implements FixtureInterface
{
    const PRODUCTS_COUNT = 5;

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        foreach ($this->prepareProducts() as $product) {
            $manager->persist($product);
        }
        $manager->flush();
    }

    /**
     * @return Product[]
     */
    private function prepareProducts(): array
    {
        $products = [];
        for ($i = 0; $i < self::PRODUCTS_COUNT; $i++) {
            $product = new Product();
            $product->setName('Test Product #' . $i);
            $product->setDescription('Description of product #' . $i);
            $product->setImage('test_product_' . $i . '.jpg');
            $product->setPrice(rand(1, 10000) / 100);
            $products[] = $product;
        }
        return $products;
    }
}