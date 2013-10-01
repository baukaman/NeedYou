<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Bauka
 * Date: 10/1/13
 * Time: 10:24 PM
 * To change this template use File | Settings | File Templates.
 */

namespace Optimus\DefaultBundle\Controller;


use Optimus\UserBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class WayController extends Controller{
    /**
     * @Route("/{handle}", name="_pathByHandle")
     * @Template()
     */
    public function handleAction($handle){

       $em = $this->getDoctrine()->getRepository("OptimusUserBundle:User");

       $user = $em->findOneBy(array("username"=>$handle));

        //$user = $em->findOneByName($handle);
        if(!$user){
            throw new NotFoundHttpException("not found such user");
        }

       return array('user'=>$user);
    }
}