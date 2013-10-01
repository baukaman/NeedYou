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
    	//$t = "anonym";

        if($this->get('security.context')->isGranted('ROLE_USER')){
            return array('name'=>$user->getUsername());
        }

        return $this->redirect($this->generateUrl('_login'));

//    	if($user){
//    	  $t = $user->getUsername();
//    	}
//        return array('name' => $t);
    }

    /**
     * @Route("/leftBar", name="_leftBar")
     * @Template()
     */
    public function leftBarAction()
    {

      return array("last_username"=>"","alone"=>"true");
    }

    /**
     * @Route("/register",name="_register")
     * @Template()
     */
    public function registerAction(){
        if($this->get('security.context')->isGranted('ROLE_USER'))
            return $this->redirect($this->generateUrl('_feed'));

        return array();
    }

}
