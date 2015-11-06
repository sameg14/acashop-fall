<?php

namespace Aca\Bundle\ShopBundle\Service;

use Simplon\Mysql\Mysql;
use Symfony\Component\HttpFoundation\Session\Session;

class CartService
{
    /**
     * Database class
     * @var Mysql
     */
    protected $db;

    /**
     * Session object
     * @var Session
     */
    protected $session;

    public function __construct(Mysql $db, Session $session)
    {
        $this->db = $db;
        $this->session = $session;
    }

    /**
     * Add a product to the cart
     * @param int $productId
     * @param int $quantity
     * @return bool
     */
    public function addProduct($productId, $quantity)
    {

    }

    /**
     * Create a cart record, and return the Id, if it doesn't exist
     * If it does exist, just return the Id
     * @return int
     */
    public function getCartId()
    {
        //check if user has a cart
        $userId = $this->session->get('user_id');

        $cartId =
            'select
                id
            from
                aca_cart
            where
                id = ' . $userId;

        $data = $this->db->fetchRow($cartId);

        if (empty($data)) {

            $cartId = $this->db->insert('aca_cart', array('user_id' => $userId));

        } else {

            $cartId = $data['id'];
        }

        return $cartId;
    }
}