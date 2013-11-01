<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Bauyrzhan.Makhambeto
 * Date: 23.10.13
 * Time: 14:08
 * To change this template use File | Settings | File Templates.
 */

namespace Optimus\DefaultBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Response;

class AjaxController extends Controller {

    /**
     * @Route("/ts_work")
     * @Template()
     */
    public function tsAction(){

        $txt = $this->get('request')->get('txt');
        $users = $this->get('UserService')->friendsByPattern($txt,$this->getUser()->getId());
        $users2 = $this->get('UserService')->notFriendsByPattern($txt,$this->getUser()->getId());
        $names = array();
        $photos = array();
        $names2 = array();
        $photos2 = array();



        foreach($users as $user){
            $names[]=$user->getUsername();
            $photos[]=$user->getPic();
        }

        foreach($users2 as $user){
            $names2[]=$user->getUsername();
            $photos2[]=$user->getPic();
        }

        $response = array("code"=>100,"success"=>"true","photos"=>$photos,"names"=>$names,"names2"=>$names2,"photos2"=>$photos2);
        return new Response(json_encode($response));
    }

}