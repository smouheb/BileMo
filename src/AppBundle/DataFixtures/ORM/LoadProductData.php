<?php
/**
 * Created by PhpStorm.
 * User: MacBookAir
 * Date: 09/07/2018
 * Time: 20:57
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\DataFixtures;
use AppBundle\Entity\Product;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;


class LoadProductData extends Fixture
{

    public function load(ObjectManager $manager)
    {
        /*
         * name, type, size, memory, color, battery, price
         */

        $phonestuff = [
            [   'Iphone6',
                'Smartphone',
                '64GB',
                '3inch',
                'Red',
                'ir34',
                '405 euros'
            ],
            [
                'Hiuwaei',
                'Smartphone',
                '64GB',
                '5inch',
                'White',
                'XE78',
                '405 euros'
            ],
            [
                'Samsung',
                'Smartphone',
                '64GB',
                '3 inch',
                'Yellow',
                'RE45',
                '567 euros'
            ],
            [
                'Blackberry',
                'Olfashion',
                '64GB',
                '3 inch',
                'Grey',
                'KO54',
                '405 euros'
            ],
            [
                'Iphone5',
                'Olfashion',
                '64GB',
                '3 inch',
                'Blue',
                'ZE45',
                '340 euros'
            ]
        ];

        //loop through the array and hydrate product object
        foreach ($phonestuff as list($name, $type, $memory, $size, $color, $battery, $price)){

            $product = new Product();
            $product->setName($name);
            $product->setType($type);
            $product->setMemory($memory);
            $product->setSize($size);
            $product->setColor($color);
            $product->setBattery($battery);
            $product->setPrice($price);

            $manager->persist($product);

        };

        $manager->flush();


    }
}