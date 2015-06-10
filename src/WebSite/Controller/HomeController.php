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

        else if ($_SESSION['type']['type'] == 'root'){
            $form = $response->rootLogInInterface();
            return [
                'view' => '/home/homeLogin.html.twig',
                'home_login' => $form
            ];
        }

        else if($_SESSION['type']['type'] == 'prof'){
            $form = $response->profLogInInterface();
            return [
                'view' => '/home/homeLogin.html.twig',
                'home_login' => $form
            ];
        }

        else {
            $form = $response->getLogInterface();
            return [
                'view' => '/home/homeLogin.html.twig',
                'home_login' => $form
            ];
        }
    }
    public function homeBackOfficeAction(){
        $response = new HtmlResponse();
        if(isset($_SESSION)){
            if($_SESSION['type']['type'] == 'root'){
                $form = $response->rootLogInInterface();
                return [
                    'view' => '/home/backOfficeMenu.html.twig',
                    'home_backOffice' => $form
                ];
            }
            else if($_SESSION['type']['type'] == 'prof'){
                $form = $response->profLogInInterface();
                return [
                    'view' => '/home/backOfficeMenu.html.twig',
                    'home_backOffice' => $form
                ];
            }

            else {
                $form = $response->getLogInterface();
                return [
                    'view' => '/home/backOfficeMenu.html.twig',
                    'home_backOffice' => $form
                ];
            }
        }
    }
}