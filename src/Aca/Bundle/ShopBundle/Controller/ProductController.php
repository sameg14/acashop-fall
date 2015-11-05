<?php

namespace Aca\Bundle\ShopBundle\Controller;

use Aca\Bundle\ShopBundle\Db\Database;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProductController extends Controller
{
    /**
     * Show all Products
     * @return Response
     */
    public function showAllAction()
    {
        $db = $this->get('acadb');

        // 1. Write a query to get all products
        $query = "select * from aca_product";
        $productRows = $db->fetchRowMany($query);

        // 2. Create a template
        // Done

        // 3. Hand off the data to the template
        return $this->render(
            'AcaShopBundle:Product:all.products.html.twig',
            array(
                'products' => $productRows
            )
        );

        // 4. loops in twig
    }

    /**
     * Show one product detail
     * @param string $slug SEF URL string
     * @return Response
     */
    public function showOneAction($slug)
    {
        $db = $this->get('acadb');

        $query = '
        select
            *
        from
            aca_product
        where
            slug = :mySlug';

        $product = $db->fetchRow($query, array('mySlug' => $slug));

        return $this->render(
            'AcaShopBundle:Product:product.detail.html.twig',
            array(
                'product' => $product
            )
        );
    }
}

/*
 * Timebox 5 minutes (how to add a field to mysql)
 * 1. Create a field called slug in the product table
 *     "Alex"
 *     Talk about data types (char[100], varchar[100], text)
 *
 * 2. Populate the slug with some value
 *
 * 3. Make a hyperlink for each product using this slug
 *
 * 4. Create a route for the new page, with a variable for the slug
 *
 * 5. Create a controller for the new route
 *
 * 6. Create a method in the controller to handle the
 *    product detail page with the slug
 *
 * 7. Figure out which product you should display using the slug
 *
 * http://www.epicurious.com/recipes/food/views/goan-curried-clams
 *
 */