<?php

namespace Aca\Bundle\ShopBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render(
            'AcaShopBundle:Default:index.html.twig'
        );
    }
}
