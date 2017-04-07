<?php

namespace BackBundle\DataFixtures\ORM;

use BackBundle\Entity\Product;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadProducts implements FixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $product = (new Product())
            ->setName('Testing Product #1')
            ->setPrice(9.95);

        $manager->persist($product);
        $manager->flush();
    }
}