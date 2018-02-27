<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Product;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadTestData implements FixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $product = (new Product())
            ->setBattery('Qualcomm battery')
            ->setColor('balck')
            ->setMemory('64GB')
            ->setName('Samsung Galaxy 8')
            ->setType('Smart Phone')
            ->setSize('5.5')
            ->setPrice('350');

        $manager->persist($product);
        $manager->flush();

    }
}