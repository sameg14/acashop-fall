<?php

namespace Aca\Bundle\ShopBundle\Controller;

use Aca\Bundle\ShopBundle\Db\Database;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name, $age)
    {
        return $this->render(
            'AcaShopBundle:Default:index.html.twig',
            array(
                'name' => $name,
                'age' => $age
            )
        );
    }
}
