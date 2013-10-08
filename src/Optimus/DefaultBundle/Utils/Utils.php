<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Bauka
 * Date: 10/8/13
 * Time: 10:39 PM
 * To change this template use File | Settings | File Templates.
 */

namespace Optimus\DefaultBundle\Utils;


class Utils {

    function generateRandomString($length = 10) {
        $characters = 'abcdefghijklmnopqrstuvwxyz';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }

}