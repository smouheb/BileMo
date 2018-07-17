<?php

namespace AppBundle\Controller;

use AppBundle\Entity\EntityUpdate;
use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Swagger\Annotations as SWG;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class ClientController extends FOSRestController
{
    /**
     * @SWG\Response(
     *
     *     response=200,
     *     description="This will provide you with the details of the related user",
     *
     *      )
     * @SWG\Response(
     *
     *      response="401",
     *      description="You need to be authorized to access the api"
     *
     *      )
     * @SWG\Parameter(
     *
     *      name="Authorization",
     *      in="header",
     *      description="As a client you need to pass your token in the header with Bearer {jwt}",
     *      required=true,
     *      type="string"
     *
     *     )
     *
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
     * @SWG\Response(
     *
     *     response="200",
     *     description="This will provide you with the users link to your client id"
     *
     *      )
     * @SWG\Response(
     *
     *      response="401",
     *      description="You need to be authorized to access the api"
     *
     *      )
     * @SWG\Parameter(
     *
     *      name="Authorization",
     *      in="header",
     *      description="As a client you need to pass your token in the header with Bearer {jwt}",
     *      required=true,
     *      type="string"
     *
     *     )
     *
     * @Rest\Get(path="/clients/{id}", name="Client")
     *
     * @Rest\View(statusCode = 200)
     *
     * @Cache(public=true,maxage=30)
     *
     */
    public function listOfUserPerClientAction(Request $request, $id)
    {
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {

            throw new AccessDeniedException();

        }


        $em = $this->getDoctrine()->getManager();
        $query = $em->getRepository(User::class)
                    ->listOfRelatedUsers($id);


        if($query != null)
        {
            return $query;

        } else{

            return new Response(json_encode('Client specified is not registered'));
        }

    }

    /**
     * @SWG\Response(
     *
     *     response=201,
     *     description="This will create a new user",
     *
     *      )
     * @SWG\Response(
     *
     *      response="401",
     *      description="You need to be authorized to access the api"
     *
     *      )
     * @SWG\Parameter(
     *
     *      name="Authorization",
     *      in="header",
     *      description="As a client you need to pass your token in the header with Bearer {jwt}",
     *      required=true,
     *      type="string"
     *
     *     )
     * @Rest\Post(path="/users", name="user-creation")
     *
     * @Rest\View(statusCode = 201)
     *
     * @ParamConverter("user", converter="fos_rest.request_body")
     */
    public function postUserAction(Request $request, User $user)
    {
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {

            throw new AccessDeniedException();

        }

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
                        'id' => $user->getId()], UrlGeneratorInterface::ABSOLUTE_URL


               )
           ]
       );
    }

    /**
     * @SWG\Response(
     *
     *     response=204,
     *     description="This will delete the related user",
     *
     *      )
     * @SWG\Response(
     *
     *      response="401",
     *      description="You need to be authorized to access the api"
     *
     *      )
     * @SWG\Parameter(
     *
     *      name="Authorization",
     *      in="header",
     *      description="As a client you need to pass your token in the header with Bearer {jwt}",
     *      required=true,
     *      type="string"
     *
     *     )
     *
     * @Rest\Delete(path="/users/{id}", name="user-deletion")
     *
     * @Rest\View(statusCode = 204)
     *
     */
    public function deleteUserAction(User $user)
    {
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {

            throw new AccessDeniedException();

        }

        $em = $this->getDoctrine()
                   ->getManager();

        $em->remove($user);

        $em->flush();

    }

    /**
     * @param User $user
     * @param $id
     *
     * @SWG\Response(
     *
     *     response=200,
     *     description="This will modify the related user",
     *
     *      )
     * @SWG\Response(
     *
     *      response="401",
     *      description="You need to be authorized to access the api"
     *
     *      )
     * @SWG\Parameter(
     *
     *      name="Authorization",
     *      in="header",
     *      description="As a client you need to pass your token in the header with Bearer {jwt}",
     *      required=true,
     *      type="string"
     *
     *     )
     *
     * @Rest\Put(path="/users/{id}", name="user-modification")
     *
     * @Rest\View(statusCode=200)
     */
    public function modifyUserAction(Request $request, User $user, $id)
    {
       if (!$this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {

            throw new AccessDeniedException();

        }

        $errors = $this->get('validator')->validate($user);

        if(count($errors)){

            return $this->view($errors, Response::HTTP_BAD_REQUEST);
        }

        $usermanager = $this->container->get('fos_user.user_manager');

        $user = $usermanager->findUserBy(array('id'=>$id));

        if($request->get('username')!= $user->getUsername() || ($request->get('email') != $user->getEmail())){

            $user->setUserName($request->get('username'));
            $user->setEmail($request->get('email'));
            $user->setUpdatedAt(new \DateTime('now'));

            $em = $this->getDoctrine()->getManager();

            $em->persist($user);
            $em->flush();

            return $this->view($user, Response::HTTP_OK,
                [
                    'Location' => $this->generateUrl("Users",

                        [
                            'id' => $user->getId()], UrlGeneratorInterface::ABSOLUTE_URL

                    )
                ]
            );
        }
        return new Response(json_encode('Nothing to modify'));

    }

}