<?php

namespace Aca\Bundle\ShopBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class OrderController
 * @package Aca\Bundle\ShopBundle\Controller
 */
class OrderController extends Controller
{
    /**
     * Place an order
     * @param Request $request
     * @return RedirectResponse
     */
    public function placeOrderAction(Request $request)
    {
        $submitCheck = $request->get('submit_check');

        if (empty($submitCheck) || $submitCheck != 1) {
            return new RedirectResponse('/cart');
        }

        // Create a service called OrderService
        // The service should have a method called placeOrder

        $order = $this->get('order');

        $order->placeOrder();

        die('I am here');

        // Solve this one: 10 minutes!!!
        // Take everything from the cart family of tables and move it to the order tables
        // Delete the contents of the cart (DB)

        return new RedirectResponse('/thank_you');

        // Add the completed_order_id to session
        // Redirect them to a receipt page (/receipt || /thank_you)
        // more requirements to follow...
    }
}