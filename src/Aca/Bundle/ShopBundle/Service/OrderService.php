<?php

namespace Aca\Bundle\ShopBundle\Service;

use Simplon\Mysql\Mysql;
use Aca\Bundle\ShopBundle\Service\CartService;
use Symfony\Component\HttpFoundation\Session\Session;

class OrderService
{
    /**
     * @var Mysql
     */
    protected $db;

    /**
     * @var Session
     */
    protected $session;

    /**
     * @var CartService
     */
    protected $cart;

    public function __construct($db, $session, $cart)
    {
        $this->db = $db;
        $this->session = $session;
        $this->cart = $cart;
    }

    /**
     * Place an order
     * @return void
     * @todo: lets send a receipt email here
     */
    public function placeOrder()
    {
        $cartProducts = $this->cart->getAllCartProducts();

        $orderId = $this->createOrderRecord();

        foreach ($cartProducts as $cartProduct) {

            $this->db->insert(
                'aca_order_product',
                array(
                    'order_id' => $orderId,
                    'product_id' => $cartProduct['product_id'],
                    'quantity' => $cartProduct['qty'],
                    'price' => $cartProduct['price']
                )
            );
        }

        // Clear the existing cart
        $this->cart->nixCart();

        $this->session->set('completed_order_id', $orderId);
    }

    /**
     * Create a new order record and return the last inserted orderId
     * @return int
     */
    protected function createOrderRecord()
    {
        $userId = $this->session->get('user_id');

        return $this->db->insert('aca_order',
            array(
                'user_id' => $userId,
                'order_date' => 'now()'
            )
        );
    }
}
