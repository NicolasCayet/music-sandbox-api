<?php

namespace App\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SecurityController extends Controller
{
    public function loginAction(Request $request)
    {
        $helper = $this->get('security.authentication_utils');
        // if no target path specified, set target to admin homepage
        if (!$request->getSession()->get('_security.admin_secured_area.target_path')) {
            $request->getSession()->set('_security.admin_secured_area.target_path', 'app_admin_homepage');
        }

        return $this->render('AppAdminBundle:Security:login.html.twig', array(
            // last username entered by the user
            'last_username' => $helper->getLastUsername(),
            'error'         => $helper->getLastAuthenticationError(),
        ));
    }
}
