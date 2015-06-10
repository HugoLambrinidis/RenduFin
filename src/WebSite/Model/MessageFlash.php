<?php

namespace Website\Model;

class MessageFlash {

    public function __construct()
    {
        if(!isset($_SESSION)){
            session_start();
            $_SESSION["user"] = 1;
            unset($_SESSION["user"]);
        }
    }

    public function addMessageFlash($type, $message)
    {
        $types = ['success','error','alert','info'];
        if (!in_array($type, $types)){
            return false;
        }
        if (!isset($_SESSION['flashBag'])) {
            $_SESSION['flashBag'] = [];
        }
        $message = ["type"=>$type,"message"=>$message];
        $_SESSION['flashBag'][] = $message;
    }

    public function printMessageFlash()
    {
        if(isset($_SESSION['flashBag'])){
            include dirname(__FILE__)."../../Model/printFlash.php";
        }
    }

}