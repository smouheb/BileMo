<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\DataFixtures;
use AppBundle\Entity\Client;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LoadTestData extends Fixture
{
    public function load(ObjectManager $manager)
    {
         $data = 'Corporation';


    for ($i = 0; $i < 100; $i++){

           $client = new Client();
           $client->setClientname($data.$i);

            $manager->persist($client);
    }
        $manager->flush();
    }
}