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
     */
    public function tsAction(){
        $txt = $this->get('request')->get('txt');
        $users = $this->get('UserService')->findbyPattern($txt);
        $names = array();
        $photos = array();
        foreach($users as $user){
            $names[]=$user->getUsername();
            $photos[]=$user->getPic();
        }
        $response = array("code"=>100,"success"=>"true","photos"=>$photos,"names"=>$names,"names2"=>array('Baukaman'),"photos2"=>array());
        return new Response(json_encode($response));
    }

}