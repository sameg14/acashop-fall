<?php

namespace Aca\Bundle\ShopBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Aca\Bundle\ShopBundle\Db\Database;
use Symfony\Component\HttpFoundation\Request;

class LoginController extends Controller
{

    public function loginFormAction(Request $request)
    {
        $session = $this->get('session');

        $msg = null;

        $username = $request->get('username');
        $password = $request->get('password');

        $query = '
        select
            *
        from
            aca_user
        where
            username = "' . $username . '"
            and password = "' . $password . '"';

        $db = new Database();
        $data = $db->fetchRowMany($query);

        if (empty($data) && !empty($username) && !empty($password)) { // Invalid login

            $msg = 'Please check your credentials';
            $session->set('isLoggedIn', false);

        } else { // Valid login

            $row = array_pop($data);
            $name = $row['name']; // person's name

            $session->set('isLoggedIn', true);
            $session->set('name', $name);
        }

        $loggedIn = $session->get('isLoggedIn');
        $name = $session->get('name');

        return $this->render(
            'AcaShopBundle:LoginForm2:smurf.html.twig',
            array(
                'loggedIn' => $loggedIn,
                'name' => $name,
                'msg' => $msg,
                'username' => $username,
                'password' => $password
            )
        );
    }
}
