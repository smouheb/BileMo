<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\DataFixtures;
use AppBundle\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LoadTestData extends Fixture
{
    public function load(ObjectManager $manager)
    {
         $name = array('Smart Phone', 'Android Phone', 'Phablet', 'iPhone');
         $type = array('iPhone 6', 'Samsung Galaxy 3', 'Samsung Galaxy 6', 'iPhone 7');
         $battery = array('Qualcomm battery', 'Battery test', 'Battery test2', 'Battery tet3');
         $color = array('Rouge', 'Bleu', 'Noir', 'Gris');


    for ($i = 0; $i < 100; $i++){


        for ($x = 0; $x < 4; $x++){

            $product = new Product();
            $product->setSize(mt_rand(4, 5.5));
            $product->setPrice(mt_rand(250, 890));
            $product->setName($name[$x]);
            $product->setType($type[$x]);
            $product->setColor($color[$x]);
            $product->setBattery($battery[$x]);
            $product->setMemory(mt_rand(15, 64).'GB');

            $manager->persist($product);
        }
    }
        $manager->flush();
    }
}