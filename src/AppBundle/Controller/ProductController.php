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
use Swagger\Annotations as SWG;

class ProductController extends FOSRestController
{
    /**
     *  @SWG\Get(
     *     path="/products",
     *     summary="Get products",
     *     description="Get products",
     *     operationId="listOfAllProductsAction",
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *         name="order",
     *         in="query",
     *         description="Order criterion",
     *         type="string",
     *     ),
     *     @SWG\Parameter(
     *         name="dir",
     *         in="query",
     *         description="Sort criterion",
     *         type="string",
     *     ),
     *     @SWG\Parameter(
     *         name="page",
     *         in="query",
     *         description="Page number",
     *         type="integer",
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     *
     * @Rest\Get(path="/products", name="list-of-products")
     *
     * @Rest\View(statusCode = 200)
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
     * @Rest\Get(path="/products/{id}", name="Product-details")
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