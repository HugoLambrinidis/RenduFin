<?php

namespace Website\Controller;

use Website\Model\MessageFlash;
use Website\Model\HtmlResponse;

class RootController extends AbstractBaseController{

    public function modifyInfosRootAction($request)
    {
        $userManager = $this->getRootManager();
        $getForm = new HtmlResponse();
        $message = new MessageFlash();
        if ($_SESSION['type']['type'] == 'root') {
            if ($request['request']) {
                if (isset($_POST['modifications'])) {
                    $_SESSION['modify_user'] = $_POST['name'];
                    if ($_POST['modifications'] == 'password') {
                        $form = $getForm->modifyPwd();
                        return [
                            'view' => '/root/modifyInfos.html.twig',
                            'root_modify' => $form
                        ];
                    } else if ($_POST['modifications'] == 'adresse') {
                        $form = $getForm->modifyAdress();
                        return [
                            'view' => '/root/modifyInfos.html.twig',
                            'root_modify' => $form
                        ];
                    } else if ($_POST['modifications'] == 'mail') {
                        $form = $getForm->modifyMail();
                        return [
                            'view' => '/root/modifyInfos.html.twig',
                            'root_modify' => $form
                        ];
                    }
                } else if (!isset($_POST['modifications'])) {
                    $name = $_SESSION['modify_user'];
                    if (isset($_POST['password']) && isset($_POST['passwordCheck'])) {
                        $password = $_POST['password'];
                        $userManager->updateUsersPasswd($name, $password);
                        $message->addMessageFlash('success', 'Le mot de passe a bien été changé pour ' . $name . ' !');
                        unset($_SESSION['modify_user']);
                        return [
                            'redirect_to' => 'index.php?p=home_backOffice'
                        ];
                    } else if (isset($_POST['adresse']) && isset($_POST['postalCode'])) {
                        $adresse = $_POST['adresse'];
                        $postalCode = $_POST['postalCode'];
                        $userManager->updateUserAdress($name, $adresse, $postalCode);
                        $message->addMessageFlash('success', "L'adresse a été changé");
                        unset($_SESSION['modify_user']);
                        return [
                            'redirect_to' => 'index.php?p=home_backOffice'
                        ];
                    } else if (isset($_POST['mail'])) {
                        $mail = $_POST['mail'];
                        $userManager->updateUsersMail($name, $mail);
                        $message->addMessageFlash('success', 'Le mail a bien été changé');
                        unset($_SESSION['modify_user']);
                        return [
                            'redirect_to' => 'index.php?p=home_backOffice'
                        ];
                    } else {
                        $message->addMessageFlash('info', 'Veuillez remplir les champs');
                    }
                } else {
                    $message->addMessageFlash('info', 'Veuillez choisir un élément à modifier');
                }
            } else {
                $form = $getForm->modifyRoot();
                return [
                    'view' => '/root/modifyInfos.html.twig',
                    'root_modify' => $form
                ];
            }
        } else {
            $message->addMessageFlash('error', "Vous n'avez pas les droits pour accéder à cette page !");
            return [
                'redirect_to' => 'index.php?p=home_backOffice'
            ];
        }

    }

    public function rootAddUserAction($request){
        $userManager = $this->getRootManager();
        $getForm = new HtmlResponse();
        $session = new MessageFlash();
        $form = $getForm->rootAddUserForm();
        if($_SESSION['type']['type'] == 'root'){
            if ($request['request']) {
                $name = $_POST['name'];
                $password = $_POST['password'];
                $prenom = $_POST['prenom'];
                $nom = $_POST['nom'];
                $tel = $_POST['tel'];
                $mail = $_POST['mail'];
                $adresse = $_POST['adresse'];
                $postalCode = $_POST['postalCode'];
                $type = $_POST['type'];
                $users = $userManager->getUserByName($name);
                if($users[0]['COUNT(`user_name`)'] < 1){
                    $userManager->rootAddUser($name,$password,$prenom,$nom,$tel,$mail,$adresse,$postalCode,$type);
                    $session->addMessageFlash('success','Vous êtes désormais enregistré. Bienvenue '.$name.'!');
                    return [
                        'redirect_to' => 'index.php?p=home_backOffice'
                    ];
                }
                else {
                    $session->addMessageFlash('error','Ce pseudo existe déjà');
                }
            }
            else if (!isset($request['request'])){
                $session->addMessageFlash('info','Veuillez entrer les identifiants');
            }
            return [
                'view' => '/root/addUser.html.twig',
                'root_add' => $form
            ];
        }
        else {
            $session->addMessageFlash('error', "Vous n'avez pas les droits pour accéder à cette page !");
            return [
                'redirect_to' => 'index.php?p=home_backOffice'
            ];
        }

    }

    public function rootDeleteUserAction($request){
        $userManager = $this->getRootManager();
        $response = new HtmlResponse();
        $session = new MessageFlash();
        $form = $response->deleteUser();
        if($_SESSION['type']['type'] == 'root'){
            if($request['request']){
                $name = $_POST['name'];
                $userManager->deleteUser($name);
                $session->addMessageFlash('success',"L'utilisateur a bien été supprimé");
                return [
                    'redirect_to' => 'index.php?home_backOffice'
                ];
            }
            else {
                return [
                    'view' => '/root/deleteUser.html.twig',
                    'root_delete' => $form
                ];
            }
        }
        else {
            $session->addMessageFlash('error', "Vous n'avez pas les droits pour accéder à cette page !");
            return [
                'redirect_to' => 'index.php?p=home_backOffice'
            ];
        }

    }
}

