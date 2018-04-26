<?php
/**
 * Created by PhpStorm.
 * User: MacBookAir
 * Date: 10/04/2018
 * Time: 21:46
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Product;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;


class ProductController extends FOSRestController
{
    /**
     * @Rest\Get(path="/products", name="list-of-products")
     *
     * @Rest\View(statusCode = 200, serializerGroups={"List"})
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
     *
     * @Rest\Get(path="/product/{id}", name="Product-details")
     *
     * @Rest\View(statusCode= 200)
     *
     * @param $id
     */
    public function productDetailsAction($id)
    {
        $em = $this->getDoctrine()
                   ->getRepository(Product::class);

        $query = $em->find($id);

        return $query;

    }

}