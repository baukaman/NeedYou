<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Bauka
 * Date: 10/8/13
 * Time: 10:36 PM
 * To change this template use File | Settings | File Templates.
 */

namespace Optimus\UserBundle\Controller;


use Optimus\UserBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Class UserController
 * @package Optimus\UserBundle\Controller
 *
 * @Route ("/user")
 */
class UserController extends Controller{

    /**
     * @Route("/avatar/upload")
     */
    public function avatarUploadAction(){

        $ext = ".jpg";

        if($_FILES['userfile']['type'] == 'image/gif') {
            $ext = ".gif";
        }else
        if($_FILES['userfile']['type']=='image/jpg'){
            $ext = ".jpg";
        }else
        if($_FILES['userfile']['type']=='image/png'){
            $ext = ".png";
        }else
        if($_FILES['userfile']['type']=='image/jpeg'){
            $ext = ".jpeg";
        }


        $path = $this->get('Utils')->generateRandomString(2);
        $name = $this->get('Utils')->generateRandomString(7).$ext;

        $saveAs = "/bundles/needyou/images/Impool/".$path;
        $path = "bundles\\needyou\\images\\Impool\\".$path;


        //mkdir('C:\\www\\web\\bundles\\needyou\\images\\Impool\\fuck');
        if(!file_exists($path))
          mkdir($path);
        move_uploaded_file($_FILES['userfile']['tmp_name'],$path."\\".$name);

        $saveAs = $saveAs."/".$name;


        $response = array('code'=>100,"sucess"=>"true","data"=>$_FILES['userfile']['tmp_name']);

        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository("OptimusUserBundle:User")->find($this->getUser()->getId());
        $user->setPic($saveAs);
        $em->flush();

        //$response = array('code'=>100,"sucess"=>"true","data"=>'sdf');
        return new Response(json_encode($response));
    }

    /**
     * @Route("/upload/confirmed")
     */
    public function avatarConfirmedAction(){

    }

    /**
     * @Route("/test")
     */
    public function testAction(){
        $ans = $this->get('UserService')->test();
        return new Response($ans);
    }

}