<?php

namespace Website\Controller;

use Website\Model\HtmlResponse;
class HomeController extends AbstractBaseController {

    public function __construct(){

    }

    public function homeAction(){
        $response = new HtmlResponse();
        if(count($_SESSION) < 1){
            $form = $response->getUnlogInterface();
            return [
                'view' => '/home/home.html.twig',
                'home' => $form
            ];
        }
        else if ($_SESSION['user_name']['name'] == 'root'){
            $form = $response->rootLogInInterface();
            return [
                'view' => '/home/home.html.twig',
                'home' => $form
            ];
        }
        else {
            $form = $response->getLogInterface();
            return [
                'view' => '/home/home.html.twig',
                'home' => $form
            ];
        }
    }
}