<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\DataFixtures;
use AppBundle\Entity\Client;
use AppBundle\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Doctrine\ORM\NativeQuery;

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

        $user = new User();

        $user->setUsername('testuser1');
        $user->setEmail('user@test.com');
        $user->setPassword('testuser1');
        $user->setClient($clientid);
        $user->setRoles(array('ROLE_SUPER_ADMIN'));

        return $user;

        //creer quelque chose pour que qd l'utilisateur recupere directement le premier client crée
    }


    public function loadClient()
    {
        $client = new Client();

        $client->setClientName('TestClient');
        $client->setAllowedGrantTypes(array('password'));


        return $client;

    }

}