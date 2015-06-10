<?php

namespace Website\Controller;

use Website\Model\HtmlResponse;
use Website\Model\MessageFlash;

class ProductController extends AbstractBaseController{


    public function getAboAction($request){
        $ProductManager = $this->getProductManager();
        $message = new MessageFlash();
        $response = $ProductManager->showIdAbo();
        $idUser = $_SESSION['id_user']['id'];
        if(isset($_SESSION)){
            if($_SESSION['type']['type'] == 'user' && !isset($_SESSION['abo']['id_abo'])){
                if($request['request']){
                    $idAbo = $_POST['id_abo'];
                    $ProductManager->getAbo($idUser,$idAbo);
                    $_SESSION['abo']['id_abo'] = $idAbo;
                    $message->addMessageFlash('success', 'Vous venez de vous abonner !');
                    return [
                        'redirect_to' => 'index.php?p=home_backOffice'
                    ];
                }
                else {
                    return [
                        'view' => '/product/getAbo.html.twig',
                        'user_getAbo' => $response
                    ];
                }
            }
            else if($_SESSION['type']['type'] == 'user' && isset($_SESSION['abo']['id_abo'])){
                $message->addMessageFlash('info','Veuillez vous désabonner avant de souscrire un nouvel abonnement !');
                return [
                    'redirect_to' => 'index.php?p=home_backOffice'
                ];
            }
            else {
                $this->showAboAction($request);
            }

        }
        else {
            $this->showAboAction($request);
        }
    }

    public function showAboAction($request){
        $ProductManager = $this->getProductManager();
        $response = $ProductManager->showAbo();
        return [
            'view' => '/product/userShowAbo.html.twig',
            'user_showAbo' => $response
        ];
    }

    public function manageAboAction($request){
        $ProductManager = $this->getProductManager();
        $getForm = new HtmlResponse();
        $message = new MessageFlash();
        if(isset($_SESSION) && $_SESSION['type']['type'] == 'user' && isset($_SESSION['abo'])){
            $id = $_SESSION['id_user']['id'];
            $abo = $ProductManager->showUsersAbo($id);
            $form = $getForm->cancelAbo();
            $response = array_merge($abo[0],$form);
            return [
                'view' => '/product/userManageAbo.html.twig',
                'user_manageAbo' => $response
            ];
        }
        else if (isset($_SESSION) && $_SESSION['type']['type'] == 'root'){
            if($request['request']){
                $id = $_POST['id'];
                $response = $ProductManager->showUserByAbo($id);
                return [
                    'view' => '/product/rootManageAbo.html.twig',
                    'user_manageAbo' => $response
                ];
            }
            else {
                $form = $getForm->getId();
                return [
                    'view' => '/product/userManageAbo.html.twig',
                    'user_manageAbo' => $form
                ];
            }
        }
        else if (isset($_SESSION) && $_SESSION['type']['type'] !== 'user'){
            $message->addMessageFlash('info' , 'Vous ne pouvez pas vous abonner !');
            return [
                'redirect_to' => 'index.php?p=home_backOffice'
            ];
        }
        else if(isset($_SESSION) && !isset($_SESSION['abo']) ){
            $message->addMessageFlash('info', 'Veuillez souscrire un abonnement avant !');
            return [
                'redirect_to' => 'index.php?p=home_backOffice'
            ];
        }
        else {
            $message->addMessageFlash('info', 'Veuillez vous connecter');
            return [
                'redirect_to' => 'index.php?p=home_backOffice'
            ];
        }


    }

    public function AddRootAbonnement($request){
        $ProductManager = $this->getProductManager();
        $response = new HtmlResponse();
        $message = new MessageFlash();
        $form = $response->AddAbonnement();
        if($_SESSION['type']['type'] == 'root'){
            if($request['request']){
                $name = $_POST['name'];
                $valeur = $_POST['valeur'];
                $ProductManager->addRootAbonnement($name,$valeur);
                $message->addMessageFlash('success', 'Vous venez de créer un nouvel abonnement');
                return [
                    'redirect_to' => 'index.php?p=home_backOffice'
                ];
            }
            else {
                return [
                    'view' => '/product/addAbonnement.html.twig',
                    'root_abo' => $form
                ];
            }
        }
        else {
            $message->addMessageFlash('error', "Vous n'avez pas les droits pour accéder à cette page");
            return [
                'redirect_to' => 'index.php?p=home_backOffice'
            ];
        }
    }

    public function deleteRootAbonnement($request){
        $ProductManager = $this->getProductManager();
        $response = new HtmlResponse();
        $message = new MessageFlash();
        $form = $response->deleteAbo();
        if($_SESSION['type']['type'] == 'root'){
            if($request['request']){
                $name = $_POST['name'];
                $ProductManager->deleteRootAbo($name);
                $message->addMessageFlash('success', 'Vous venez de supprimer un abonnement');
                return [
                    'redirect_to' => 'index.php?p=home_backOffice'
                ];
            }
            else {
                return [
                    'view' => '/product/deleteAbonnement.html.twig',
                    'root_aboDelete' => $form
                ];
            }
        }
        else {
            $message->addMessageFlash('error', "Vous n'avez pas les droits pour accéder à cette page");
            return [
                'redirect_to' => 'index.php?p=home_backOffice'
            ];
        }
    }
}