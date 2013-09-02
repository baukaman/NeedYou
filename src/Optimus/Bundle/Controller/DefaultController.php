<?php

namespace Optimus\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;


class DefaultController extends Controller
{
    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {
        return array();
        //return new Response("Default page");
    }

    /**
     * @Route("/hello/{name}")
     * @Template()
     */
    public function helloAction($name)
    {
    	return array('name' => $name);
    }

}
