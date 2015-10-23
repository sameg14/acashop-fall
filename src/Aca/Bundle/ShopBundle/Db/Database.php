<?php

namespace Aca\Bundle\ShopBundle\Db;

use \mysqli;
use \Exception;

/**
 * Class Database
 * @package Aca\Bundle\ShopBundle\Db
 */
class Database
{
    /**
     * @var mysqli
     */
    protected $db;

    public function __construct()
    {
        $this->db = new mysqli("localhost", "root", "root", "acashop");
        if ($this->db->connect_errno) {
            throw new Exception(
                "Failed to connect to MySQL: (" . $this->db->connect_errno . ") " . $this->db->connect_error
            );
        }
    }

    /**
     * Get many rows from the DB
     * @param string $query SQL query
     * @return array Assoc array of data from DB
     */
    public function fetchRowMany($query)
    {
        $return = [];
        $result = $this->db->query($query);

        while($row = $result->fetch_assoc()){
            $return[] = $row;
        }

        return $return;
    }
}