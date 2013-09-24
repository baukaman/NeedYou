<?php

namespace Optimus\DefaultBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


class DefaultController extends Controller
{

    /**
     * @Route("/feed/", name="_feed")
     * @Template()
     */
    public function indexAction()
    {
    	$user = $this->getUser();
    	$t = "anonym";

    	if($user){
    	  $t = $user->getUsername();
    	}
        return array('name' => $t);
    }
}
