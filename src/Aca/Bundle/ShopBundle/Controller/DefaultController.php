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

    public function loginFormAction()
    {
        return $this->render(
            'AcaShopBundle:LoginForm:login.form.samir.html.twig'
        );
    }

    public function processLoginAction(Request $request)
    {
        $username = $request->get('username');
        echo '$username=' . $username . '<br/>';

        $password = $request->get('password');
        echo '$password=' . $password . '<br/>';

        $query = "
        select
            user_id
        from
            aca_user
        where
            username = '$username'
            and password = '$password';";
        
        $db = new Database();
        $data = $db->fetchRows($query);

        print_r($data);

        die();

//        $username = $_POST['username'];
//        $password = $_POST['password'];

        // Run a query against the DB
        // Check for the record that exists or not
        // If you find a record, its a valid user
        // If you dont, they are not valid.

        // If they are valid, set things to session
        // Make the login boxes go away!
    }
}
