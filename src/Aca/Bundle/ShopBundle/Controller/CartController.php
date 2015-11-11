<?php

namespace Aca\Bundle\ShopBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Class CartController deals with all things related to the cart
 * @package Aca\Bundle\ShopBundle\Controller
 */
class CartController extends Controller
{
    public function showCartAction()
    {
        $cart = $this->get('cart');

        $cartProducts = $cart->getAllCartProducts();

        return $this->render(
            'AcaShopBundle:Cart:show.all.html.twig',
            array(
                'cartProducts' => $cartProducts
            )
        );
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function addCartAction(Request $request)
    {
        $cart = $this->get('cart');

        $productId = $request->get('product_id');
        $quantity = $request->get('quantity');

        $cart->addProduct($productId, $quantity);

        return new RedirectResponse('/cart');
    }
}
