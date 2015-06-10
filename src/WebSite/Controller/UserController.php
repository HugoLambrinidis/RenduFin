<?php

namespace Website\Controller;

use Website\Model\HtmlResponse;
use Website\Model\MessageFlash;
use WebSite\Model\UserManager;


class UserController extends AbstractBaseController {


    public function listUserAction($request)
    {
        $userManager = $this->getUserManager();
        $message = new MessageFlash();
        $users = $userManager->getUserList();
        if ($_SESSION['type']['type'] == 'root') {
            $response = [
                'view' => '/user/listUser.html.twig',
                'user_list' => $users
            ];
            return $response;
        } else {
            $message->addMessageFlash('error', "Vous n'avez pas les droits pour accéder à cette page !");
            return [
                'redirect_to' => 'index.php?p=home_backOffice'
            ];
        }
    }

    public function showUserAction($request)
        {
            $userManager = $this->getUserManager();

            $name = $_SESSION['name']['name'];
            $user = $userManager->showUser($name);
            return [
                'view' => '/user/showUser.html.twig',
                'user_show' => $user
            ];
        }


    public function modifyInfosUsersAction($request){
        $userManager = $this->getUserManager();
        $getForm = new HtmlResponse();
        $message = new MessageFlash();
        $name = $request['session']['name']['name'];
        if($request['request']){
            if(isset($_POST['modifications'])){
                if($_POST['modifications'] == 'password'){
                    $form = $getForm->modifyPwd();
                    return [
                        'view' => '/user/modifyInfos.html.twig',
                        'user_modify' => $form
                    ];
                }
                else if($_POST['modifications'] == 'adresse'){
                    $form = $getForm->modifyAdress();
                    return [
                        'view' => '/user/modifyInfos.html.twig',
                        'user_modify' => $form
                    ];
                }
                else if($_POST['modifications'] == 'mail'){
                    $form = $getForm->modifyMail();
                    return [
                        'view' => '/user/modifyInfos.html.twig',
                        'user_modify' => $form
                    ];
                }
            }
            else if(!isset($_POST['modifcations'])){
                if(isset($_POST['password']) && isset($_POST['passwordCheck'])){
                    $password = $_POST['password'];
                    $userManager->updateUsersPasswd($name,$password);
                    $message->addMessageFlash('success', 'Votre pseudo a été changé');
                    return [
                        'redirect_to' => 'index.php?p=home_backOffice'
                    ];
                }
                else if(isset($_POST['adresse']) && isset($_POST['postalCode'])){
                    $adresse = $_POST['adresse'];
                    $postalCode = $_POST['postalCode'];
                    $userManager->updateUserAdress($name,$adresse,$postalCode);
                    $message->addMessageFlash('success', 'Votre adresse a été changé');
                    return [
                        'redirect_to' => 'index.php?p=home_backOffice'
                    ];
                }
                else if(isset($_POST['mail'])){
                    $mail = $_POST['mail'];
                    $userManager->updateUsersMail($name,$mail);
                    $message->addMessageFlash('success', 'Votre mail a bien été changé');
                    return [
                        'redirect_to' => 'index.php?p=home_backOffice'
                    ];
                }
                else {
                    $message->addMessageFlash('info', 'Veuillez remplir les champs');
                }
            }
            else {
                $message->addMessageFlash('info', 'Veuillez choisir un élément à modifier');
            }
        }
        else{
            $form = $getForm->modifyUsers();
            return [
                'view' => '/user/modifyInfos.html.twig',
                'user_modify' =>$form
            ];
        }
    }


    public function addUserAction($request) {
        $userManager = $this->getUserManager();
        $getForm = new HtmlResponse();
        $session = new MessageFlash();
        $form = $getForm->addUserForm();
        if ($request['request']) {
            $name = $_POST['name'];
            $password = $_POST['password'];
            $prenom = $_POST['prenom'];
            $nom = $_POST['nom'];
            $tel = $_POST['tel'];
            $mail = $_POST['mail'];
            $adresse = $_POST['adresse'];
            $postalCode = $_POST['postalCode'];
            $users = $userManager->getUserByName($name);
            if($users[0]['COUNT(`user_name`)'] < 1){
                $userManager->addUser($name,$password,$prenom,$nom,$tel,$mail,$adresse,$postalCode);
                $this->logUserAction($request);
                $session->addMessageFlash('success','Vous êtes désormais enregistré. Bienvenue !');
                return [
                    'redirect_to' => 'index.php?p=home_backOffice'
                ];
            }
            else {
                $session->addMessageFlash('error','Ce pseudo existe déjà');
            }
        }
        else if (!isset($request['request'])){
            $session->addMessageFlash('info','Veuillez entrer vos identifiants');
        }
        return [
            'view' => '/user/addUser.html.twig',// => create the file
            'user_add' => $form
        ];
    }

    public function deleteUserAction($request) {
        $session = new MessageFlash();
        $name = $request['session']['user_name']['name'];
        $userManager = $this->getUserManager();
        $userManager->deleteUser($name);
        session_destroy();
        $session->addMessageFlash('success','Votre compte a bien été supprimé');
        return [
            'redirect_to' => 'index.php?p=home_backOffice'
        ];
    }



    public function logUserAction($request) {
        $connect = $this->getUserManager();
        $productManager = $this->getProductManager();
        $getForm = new HtmlResponse();
        $session = new MessageFlash();
        $form = $getForm->logUserForm();
        if ($request['request']) {
            $name = $_POST['name'];
            $password = $_POST['password'];
            $connection = $connect->logUser($name, $password);
            $getId = $connect->getUserId($name);
            $getAboId = $productManager->getUserAbo($getId[0]['user_id']);
            if (!empty($name) && !empty($password)) {
                if ($connection != null && $connection[0]['user_name'] == $name) {
                    $_SESSION['name'] = ['name' => $connection[0]['user_name']];
                    $_SESSION['password'] = ['password' => $connection[0]['user_pwd']];
                    $_SESSION['type'] = ['type' => $connection[0]['type']];
                    $_SESSION['id_user'] = ['id' => $getId[0]['user_id']];
                    if($_SESSION['type']['type'] == 'user' && isset($getAboId[0]['abo_id'])){
                        $_SESSION['abo'] = ['id_abo' => $getAboId[0]['abo_id']];
                    }
                    $session->addMessageFlash('success','vous êtes maintenant connecté');
                    return [
                        'redirect_to' => 'index.php?p=home_backOffice'
                    ];
                } else {
                    $session->addMessageFlash('error','identifiants inconnus');
                    return [
                        'view' => '/user/logUser.html.twig',
                        'user_log' => $form
                    ];

                }
            }
            else {
                $session->addMessageFlash('info','Entrez vos identifiants !');
                return [
                    'view' => '/user/logUser.html.twig',
                    'user_log' => $form
                ];
            }
        }

        return [
            'view' => '/user/logUser.html.twig',
            'user_log' => $form
        ];
    }

    public function logOutUserAction($request){
        session_destroy();
        $session = new MessageFlash();
        $session->addMessageFlash('success','vous êtes déconnecté, au revoir !');
        return [
            'redirect_to' => 'index.php?p=home'
        ];
    }

    public function coursInscriptionAction($request){
        $profsManager = $this->getUserManager();
        $message = new MessageFlash();
        if(isset($_SESSION['abo']['id_abo'])){
            $idUser = $_SESSION['id_user']['id'];
            $idCours = $_POST['cours_id'];
            $coursExist = $profsManager->showCoursForUser($idUser);
            $length = count($coursExist);
            for($i = 0; $i < $length; $i++ ){
                if($coursExist[$i]['cours_id'] == $idCours){
                    $message->addMessageFlash('info', 'Vous êtes déjà inscrit pour ce cours !');
                    return [
                        'redirect_to' => 'index.php?p=home_backOffice'
                    ];
                }
            }
            $profsManager->inscriptionCours($idCours,$idUser);
            $message->addMessageFlash('success','Vous vous êtes inscrits au cours !');
            return [
                'redirect_to' => 'index.php?p=home_backOffice'
            ];
        }
        else if(isset($_SESSION) && $_SESSION['type']['type'] == 'user' && !isset($_SESSION['abo'])){
            $message->addMessageFlash('info', 'Veuillez souscrire un abonnement avant');
            return [
                'redirect_to' => 'index.php?p=home_backOffice'
            ];
        }
        else if(isset($_SESSION)){
            $message->addMessageFlash('info', 'vous ne pouvez pas vous inscrire à un cours !');
            return [
                'redirect_to' => 'index.php?p=home_backOffice'
            ];
        }
        else {
            $message->addMessageFlash('error', 'Veuillez vous connecter avant');
            return [
                'redirect_to' => 'index.php?p=home'
            ];
        }
    }

    public function showUsersCoursAction($request){
        $userManager = $this->getUserManager();
        $id = $_SESSION['id_user']['id'];
        $response = $userManager->showCoursForUser($id);
        return [
            'view' => '/user/showCoursForUser.html.twig',
            'user_cours' => $response
        ];
    }
}