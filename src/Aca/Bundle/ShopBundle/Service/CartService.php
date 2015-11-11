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
        $cartId = $this->getCartId();

        $productPrice = $this->getProductPrice($productId);

        $insertedId = $this->db->insert('aca_cart_product',
            array(
                'cart_id' => $cartId,
                'product_id' => $productId,
                'qty' => $quantity,
                'unit_price' => $productPrice
            )
        );

        return !empty($insertedId) && is_int($insertedId) ? true : false;
    }

    /**
     * Get the price of one product
     * @param int $productId
     * @return float
     */
    protected function getProductPrice($productId)
    {
        $query = 'select price from aca_product where id = "' . $productId . '"';

        $row = $this->db->fetchRow($query);

        return isset($row['price']) ? $row['price'] : null;
    }

    /**
     * Create a cart record, and return the Id, if it doesn't exist
     * If it does exist, just return the Id
     * @throws \Exception
     * @return int
     */
    public function getCartId()
    {
        $userId = $this->session->get('user_id');
        if (empty($userId)) {
            throw new \Exception('You must be logged in');
        }

        $query = '
        select
            id
        from
            aca_cart
        where
            user_id = :userId';

        $row = $this->db->fetchRow($query, array('userId' => $userId));

        // We have a cart record
        if (isset($row['id']) && !empty($row)) {
            return $row['id'];
        }

        $this->db->insert('aca_cart', array('user_id' => $userId));

        return $this->getCartId();
    }

    /**
     * Get all products that are in this user's shopping cart
     * @throws \Exception
     * @return array|null
     */
    public function getAllCartProducts()
    {
        $query = '
        select
            cp.id,
            p.name,
            p.description,
            p.image,
            cp.unit_price as price,
            cp.qty
        from
            aca_cart_product as cp
            inner join aca_product as p on (p.id = cp.product_id)
            left join aca_cart as c on (c.id = cp.cart_id)
        where
            cp.cart_id = :myCartId';

        return $this->db->fetchRowMany($query,
            array(
                'myCartId' => $this->getCartId()
            )
        );
    }
}