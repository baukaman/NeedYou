<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Bauka
 * Date: 10/1/13
 * Time: 8:15 PM
 * To change this template use File | Settings | File Templates.
 */

namespace Optimus\DefaultBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Optimus\UserBundle\Entity\User;
use Optimus\UserBundle\Entity\Role;

class AuthController extends Controller{

    /**
     * @Route("/register_check", name="_register_action")
     * @Template()
     */
    public function registerSubmitAction(Request $request){

        try{
        $em = $this->getDoctrine()->getManager();
        $user = new User();
        $user->setUsername($request->get('name'));
        $user->setPassword(sha1($request->get('password')));
        $user->setEmail($request->get('email'));
        $user->setSalt("");
        $user->setPic("default");
        $role = $this->getDoctrine()->getManager()->getRepository("OptimusUserBundle:Role")->find(1);
        $user->addRole($role);
        $user->setIsActive(true);
        $em->persist($user);
        $em->flush();
        }catch (\Exception $e){
            return new Response("error: ".$e->getMessage());
        }

        return array();
    }


}