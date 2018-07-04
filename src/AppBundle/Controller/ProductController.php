<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Product;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Swagger\Annotations as SWG;

class ProductController extends FOSRestController
{
    /**
     * @SWG\Response(
     *
     *     response=200,
     *     description="BileMo api lists all products available",
     *
     *      )
     * @SWG\Response(
     *
     *      response="401",
     *      description="You need to be authorized to access the api"
     *
     *      )
     *
     * @SWG\Parameter(
     *
     *      name="Authorization",
     *      in="header",
     *      description="As a client or user,  you need to pass your token in the header section  with Bearer {jwt}",
     *      required=true,
     *      type="string"
     *
     *     )
     * @Rest\Get(path="/products", name="list-of-products")
     *
     * @Rest\View(statusCode = 200)!i
     *
     */
    public function listOfAllProductsAction()
    {
        $em = $this->getDoctrine()
                   ->getRepository(Product::class);

        $query =  $em->findAll();


        return $query;
    }

    /**
     * @SWG\Response(
     *
     *     response=200,
     *     description="This will provide you with the product related to the product id you will provide",
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
     *      description="As a client or user,  you need to pass your token in the header section with Bearer {jwt}",
     *      required=true,
     *      type="string"
     *
     *     )
     *
     * @Rest\Get(path="/products/{id}", name="Product-details")
     *
     * @Rest\View(statusCode= 200)
     *
     */
    public function productDetailsAction($id)
    {
        $em = $this->getDoctrine()
                   ->getRepository(Product::class);

        $query = $em->find($id);

        return $query;

    }

}