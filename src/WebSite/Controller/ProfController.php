<?php

namespace WebSite\Controller;

use WebSite\Controller\UserController;
use Website\Model\HtmlResponse;
use Website\Model\MessageFlash;
use WebSite\model\ProfsManager;

class ProfController extends AbstractBaseController
{


    public function showCoursAction($request)
    {
        $inscription = new UserController();
        $getForm = new HtmlResponse();
        $profsManager = new ProfsManager();
        if ($_SESSION['type']['type'] == 'root' || $_SESSION['type']['type'] == 'prof'){
            if ($request['request']) {
                if (isset($_POST['matiere'])) {
                    if ($_POST['matiere'] == 'all') {
                        $view = $profsManager->showAllCours();
                        return [
                            'view' => '/prof/showCoursBySubject.html.twig',
                            'cours_show' => $view
                        ];
                    } else if ($_POST['matiere'] !== 'all') {
                        $matiere = $_POST['matiere'];
                        $view = $profsManager->showCoursBySubject($matiere);
                        return [
                            'view' => '/prof/showCoursBySubject.html.twig',
                            'cours_show' => $view
                        ];
                    }
                }
                else {
                    $view = $getForm->showCoursBySubject();
                    return [
                        'view' => '/prof/showCours.html.twig',
                        'cours_show' => $view
                    ];
                }
            } else {
                $view = $getForm->showCoursBySubject();
                return [
                    'view' => '/prof/showCours.html.twig',
                    'cours_show' => $view
                ];
            }
        }
        else {
            if ($request['request']) {
                if (isset($_POST['matiere'])) {
                    if ($_POST['matiere'] == 'all') {
                        $view = $profsManager->showAllCours();
                        return [
                            'view' => '/user/showCoursBySubject.html.twig',
                            'cours_show' => $view
                        ];
                    } else if ($_POST['matiere'] !== 'all') {
                        $matiere = $_POST['matiere'];
                        $view = $profsManager->showCoursBySubject($matiere);
                        return [
                            'view' => '/user/showCoursBySubject.html.twig',
                            'cours_show' => $view
                        ];
                    }
                }
                else if(isset($_POST['cours_id'])){
                    $a = $inscription->coursInscriptionAction($request);
                    return $a;
                }
                else {
                    $view = $getForm->showCoursBySubject();
                    return [
                        'view' => '/user/showCours.html.twig',
                        'cours_show' => $view
                    ];
                }
            } else {
                $view = $getForm->showCoursBySubject();
                return [
                    'view' => '/user/showCours.html.twig',
                    'cours_show' => $view
                ];
            }
        }
    }

    public function addCoursAction($request)
    {
        $getForm = new HtmlResponse();
        $profsManager = new ProfsManager();
        $message = new MessageFlash();
        if($_SESSION['type']['type'] == 'root' || $_SESSION['type']['type'] == 'prof'){
            if ($request['request']) {
                $matiere = $_POST['matiere'];
                $id = $_POST['prof'];
                $debut = $_POST['debut'];
                $fin = $_POST['fin'];
                $date = $_POST['date'];
                $profsManager->addCours($matiere, $id, $debut, $fin, $date);
                $message->addMessageFlash('success', 'Le cours a été programmé !');

                return [
                    'redirect_to' => 'index.php?p=home_backOffice'
                ];
            }
            else {
                $view = $getForm->addCours();
                return [
                    'view' => '/prof/addCours.html.twig',
                    'cours_add' => $view
                ];
            }
        }
        else {
            $message->addMessageFlash('error',"Vous n'avez pas les droits pour accéder à cette page !");
            return [
                'redirect_to' => 'index.php?p=home_backOffice'
            ];
        }

    }

    public function deleteCoursAction($request)
    {
        $getForm = new HtmlResponse();
        $profsManager = new ProfsManager();
        $message = new MessageFlash();
        if($_SESSION['type']['type'] == 'root' || $_SESSION['type']['type'] == 'prof'){
            if($request['request']){
                $id = $_POST['id'];
                $profsManager->deleteCours($id);
                $message->addMessageFlash('success','Le cours a bien été supprimé');
                return [
                    'redirect_to' => 'index.php?p=home_backOffice'
                ];
            }
            else {
                $view = $getForm->deleteCours();
                return [
                    'view' => '/prof/deleteCours.html.twig',
                    'cours_delete' => $view
                ];
            }

        }
        else {
            $message->addMessageFlash('error',"Vous n'avez pas les droits pour accéder à cette page !");
            return [
                'redirect_to' => 'index.php?p=home_backOffice'
            ];
        }
    }

    public function showCoursForTeacher($request){
        $profsManager = new ProfsManager();
        $message = new MessageFlash();
        $id = $_SESSION['id_user']['id'];
        if($_SESSION['type']['type'] == 'prof'){
            $response = $profsManager->showCoursForTeacher($id);
            return [
                'view' => '/prof/showCoursForTeacher.html.twig',
                'prof_show' => $response
            ];
        }
        else {
            $message->addMessageFlash('error',"Vous n'avez pas les droits pour accéder à cette page");
            return [
                'redirect_to' => 'index.php?p=home_backOffice'
            ];
        }

    }

    public function showFollowers($request){
        $profManager = new ProfsManager();
        $getForm = new HtmlResponse();
        $message = new MessageFlash();
        if($_SESSION['type']['type'] == 'prof' || $_SESSION['type']['type'] == 'root'){
            if($request['request']){
                $id = $_POST['id'];
                $response = $profManager->followers($id);
                return [
                    'view' => '/prof/showCoursFollowers.html.twig',
                    'prof_followers' => $response
                ];
            }
            else {
                $form = $getForm->deleteCours();
                return [
                    'view' => '/prof/pickId.html.twig',
                    'prof_followers' => $form
                ];
            }
        }
        else {
            $message->addMessageFlash('error',"vous n'avez pas les droits pour accéder à cette page");
            return [
                'redirect_to' => 'index.php?p=home_backOffice'
            ];
        }
    }
}