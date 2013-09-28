<?php

namespace Optimus\DefaultBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


class DefaultController extends Controller
{
    /**
     * @Route("/", name="_index")
     * @Template()
     */
    public function indexAction(){

        $user = $this->getUser();
        if($user){
            return $this->redirect($this->generateUrl('_feed'));
        }
          return array();
    }

    /**
     * @Route("/feed", name="_feed")
     * @Template()
     */
    public function feedAction()
    {
    	$user = $this->getUser();
    	$t = "anonym";

    	if($user){
    	  $t = $user->getUsername();
    	}
        return array('name' => $t);
    }
}
