<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Bauyrzhan.Makhambeto
 * Date: 23.10.13
 * Time: 13:13
 * To change this template use File | Settings | File Templates.
 */

namespace Optimus\UserBundle\Services;


class UserService {

    protected $container;

    function __construct($container)
    {
        $this->container = $container;
    }

    function getText(){
        //$str = $this->get('Utils')->generateRandomString(2);
        //$str - $con
        $str = $this->container->get('Utils')->generateRandomString(2);
        return 'Hello '.$str;
    }

    public function friendsByPattern($pattern, $id){
        $em =  $this->container->get('Doctrine')->getManager()->getRepository('OptimusUserBundle:User');
        $res = $em->friendsByPattern($pattern,$id);
        return $res;
    }

    public function notFriendsByPattern($pattern, $id){
        $em =  $this->container->get('Doctrine')->getManager()->getRepository('OptimusUserBundle:User');
        $res = $em->notFriendsByPattern($pattern,$id);
        return $res;
    }



}