<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Bauyrzhan.Makhambeto
 * Date: 02.10.13
 * Time: 17:51
 * To change this template use File | Settings | File Templates.
 */

namespace Optimus\DefaultBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Response;

class TestController extends Controller{

    /**
     * @Route("/address", name="_address")
     */
    public function addressAction(){
       return new Response("ok address");
    }

    /**
     * @Route("/users")
     * @Template()
     */
    public function showUsersAction(){
        $users = $this->getDoctrine()->getRepository("OptimusUserBundle:User")->findAll();
        return array('users'=>$users);

    }

    /**
     * @Route("/address/show", name="_show_address")
     * @Template()
     */
    public function addressShowAction(){
        $user = $this->getUser();
        return array('user'=>$user);
    }

    /**
     * @Route("/friends/show", name="_show_friends")
     * @Template()
     */
    public function friendsShowAction(){
         return array();
    }

    /**
     * @Route("/friends/list", name="_list_friends")
     */
    public function ajaxAction(){

        $prefix = $this->get('request')->get('name');

        if(!$prefix) $prefix = '';

        if( ! $this->get('security.context')->isGranted('ROLE_USER'))
            $response = array("code"=>100,"success"=>"false");
        else{
            $friends = $this->getUser()->getFriends();
            $arr = array();
            foreach ($friends as $key=>$user){
                if($prefix==='' || strpos($user->getUsername(), $prefix) === 0 ) $arr[]=$user->getUsername();
            }
            $response = array("code"=>100,"success"=>"true","data"=>$arr);
        }

        return new Response(json_encode($response));

    }

}