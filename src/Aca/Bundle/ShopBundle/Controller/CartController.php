<?php

namespace Aca\Bundle\ShopBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class CartController deals with all things related to the cart
 * @package Aca\Bundle\ShopBundle\Controller
 */
class CartController extends Controller
{
    public function showCartAction()
    {
        return $this->render(
            'AcaShopBundle:Cart:show.all.html.twig'
        );
    }

    public function addCartAction(Request $request)
    {
        $cart = $this->get('cart');

        $productId = $request->get('product_id');
        echo '$productId=' . $productId;

        echo '<br/>';
        $quantity = $request->get('quantity');
        echo '$quantity=' . $quantity;


    }
}
