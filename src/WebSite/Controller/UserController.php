<?php
/**
 * Created by PhpStorm.
 * User: nico
 * Date: 23/04/2015
 * Time: 23:45
 */
namespace Website\Controller;

use Website\Model\HtmlResponse;
use WebSite\Model\UserManager;

/**
 * Class UserController
 *
 * Controller of all User actions
 *
 * @package Website\Controller
 */
class UserController extends AbstractBaseController {
    /**
     * Recup all users and print it
     *
     * @return array
     */

    public function listUserAction($request) {
        $userManager = new UserManager();
        $users = $userManager->getUserList();
        $response = [
            'view' => '/user/listUser.html.twig',
            'user_list' => $users
        ];
        return $response;
    }
    /**
     * swho one user thanks to his id : &id=...
     *
     * @return array
     */
    public function showUserAction($request) {
        $userManager = new UserManager();
        $name = $request['session']['user_name']['name'];
        $user = $userManager->showUser($name);
        return [
            'view' => '/user/showUser.html.twig',
            'user_show' => $user
        ];
    }

    public function addUserAction($request) {
        $userManager = new UserManager();
        $getForm = new HtmlResponse();
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
                return [
                    'redirect_to' => 'index.php?p=home'
                ];
            }
            else {
                echo "ce pseudo existe déjà !";
            }
        }
        //you should return a Response object
        return [
            'view' => '/user/addUser.html.twig',// => create the file
            'user_add' => $form
        ];
    }
    /**
     * Delete User and redirect on listUser after
     */
    public function deleteUserAction($request) {
        $name = $request['session']['user_name']['name'];
        $userManager = new UserManager();
        $userManager->deleteUser($name);
        session_destroy();
        return [
            'redirect_to' => 'index.php?p=home'
        ];
    }
    /**
     * Log User (Session) , add session in $request first (index.php)
     */
    public function logUserAction($request) {
        $connect = new UserManager();
        $getForm = new HtmlResponse();
        $form = $getForm->logUserForm();
        if ($request['request']) {

            $name = $_POST['name'];
            $password = $_POST['password'];
            $session = $connect->logUser($name, $password);
            if (!empty($name) && !empty($password)) {
                if ($session != null && $session[0]['user_name'] == $name) {
                    $_SESSION['user_name'] = ['name' => $session[0]['user_name']];
                    $_SESSION['user_pwd'] = ['password' => $session[0]['user_pwd']];
                    return [
                        'redirect_to' => 'index.php?p=home'
                    ];
                } else {
                    echo "Identifiants inconnus";
                    return [
                        'view' => '/user/logUser.html.twig',
                        'user_log' => $form
                    ];

                }
            }
            else {
                echo "Veuillez entrer vos identifiants !";
                return [
                    'view' => '/user/logUser.html.twig',
                    'user_log' => $form
                ];
            }
        }
        //take FlashBag system from
        // https://github.com/NicolasBadey/SupInternetTweeter/blob/master/model/functions.php
        // line 87 : https://github.com/NicolasBadey/SupInternetTweeter/blob/master/index.php
        // and manage error and success
        //Redirect to list or home
        //you should return a RedirectResponse object

        return [
            'view' => '/user/logUser.html.twig',
            'user_log' => $form// => manage it in index.php !! URL should be generate by Routing functions thanks to routing config
        ];
    }

    public function logOutUserAction($request){
        session_destroy();
        return [
            'redirect_to' => 'index.php?p=home'
        ];
    }
}