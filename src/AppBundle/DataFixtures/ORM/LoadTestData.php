<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\DataFixtures;
use AppBundle\Entity\Client;
use AppBundle\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LoadTestData extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $client = $this->loadClient();

        $manager->persist($client);
        $manager->flush();

        //retrieving the last inster id
        $clientid = $client->getId();

        if(!$clientid == null){

            $user = $this->loadUser($clientid);

            $manager->persist($user);

            $manager->flush();
        }

    }

    public function loadUser($clientid)
    {

        $name = 'testuser1';
        $user = new User();

        $user->setUsername($name);
        $user->setEmail('user@test.com');
        $user->setPlainPassword($name);
        $user->setClient($clientid);
        $user->setRoles(array('ROLE_ADMIN'));

        return $user;
    }


    public function loadClient()
    {
        $client = new Client();

        $client->setClientName('TestClient');
        $client->setAllowedGrantTypes(array('password'));


        return $client;

    }

}