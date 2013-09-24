<?php

namespace Optimus\DefaultBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\SecurityContext;


class SecurityController extends Controller{
	
  /**
   * @Route("/login", name="_login")
   * @Template()
   */
  public function loginAction(Request $request)
  {
  	if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = $request->getSession()->get(SecurityContext::AUTHENTICATION_ERROR);
        }

        return array(
            'last_username' => $request->getSession()->get(SecurityContext::LAST_USERNAME),
            'error'         => $error,
        );
  }

  /**
   * @Route("/logout", name="_my_security_logout")
   */
  public function logoutAction()
  {
  	//security layer will intercept this
  }

  /**
   * @Route("/test", name="_test")
   */
  public function testAction()
  {
  	return new Response("aa");
  }

}