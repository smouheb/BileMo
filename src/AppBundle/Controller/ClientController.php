<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class ClientController extends FOSRestController
{
    /**
     * @Rest\Get(path="/users/{id}", name="Users")
     *
     * @Rest\View(statusCode = 200)
     *
     */
    public function detailOfUserAction($id)
    {

        $listOfUsers = $this->getDoctrine()
                            ->getRepository('AppBundle:User')
                            ->find($id);

        return $listOfUsers;

    }

    /**
     * @Rest\Get(path="/clients/{id}", name="Client")
     *
     * @Rest\View(statusCode = 200)
     *
     */
    public function listOfUserPerClientAction($id)
    {
        //Query pour aller recuperer tous les users lié à un Client

        $em = $this->getDoctrine()
                   ->getManager();

        $query = $em->getRepository(User::class)
                    ->listOfRelatedUsers($id);

        if(!$query == null)
        {
            return $query;

        }else{

            return new Response('Client specified is not registered');
        }

    }

    /**
     * @Rest\Post(path="/users", name="user-creation")
     *
     * @Rest\View(statusCode = 201)
     *
     * @ParamConverter("user", converter="fos_rest.request_body")
     */
    public function postUserAction(Request $request, User $user)
    {

        $errors = $this->get('validator')->validate($user);

        if(count($errors)){

            return $this->view($errors, Response::HTTP_BAD_REQUEST);
        }

        $usermanager = $this->container->get('fos_user.user_manager');

        $user = $usermanager->createUser();

        $user->setUserName($request->get('username'));
        $user->setPlainPassword($request->get('password'));
        $user->setEmail($request->get('email'));
        $user->setEnabled(true);
        $user->setClient($request->get('client_id'));

        $em = $this->getDoctrine()->getManager();

        $em->persist($user);

        $em->flush();

       return $this->view($user, Response::HTTP_CREATED,
           [
               'Location' => $this->generateUrl("Users",

                    [
                        'id' => $user->getId(), UrlGeneratorInterface::ABSOLUTE_URL

                    ]
               )//remonter de bug brakets to put behing getid()
           ]
       );
    }

    /**
     * @Rest\Delete(path="/users/{id}", name="user-deletion")
     *
     * @Rest\View(statusCode = 204)
     *
     */
    public function deleteUserAction(User $user)
    {

        $em = $this->getDoctrine()
                   ->getManager();

        $em->remove($user);

        $em->flush();

    }

}