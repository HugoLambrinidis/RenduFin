<?php

namespace Website\Model;

class HtmlResponse {

    public function addUserForm(){
        $form = [
            'form' => '<form method="post"> <br>',
            'name' => 'pseudo :<input type="text" name="name"> <br>',
            'passwd' => 'mot de passe :<input type="password" name="password"> <br>',
            'passwdCheck' => 'réentrer mot de passe :<input type="password"> <br>',
            'prenom' => 'prenom :<input type="text" name="prenom"> <br>',
            'nom' => 'nom :<input type="text" name="nom"> <br>',
            'tel' => 'telephone :<input type="tel" name="tel"> <br>',
            'mail' => 'mail :<input type="email" name="mail"> <br>',
            'adresse' => 'adresse :<input type="text" name="adresse"> <br>',
            'postalCode' => 'Code Postal :<input type="int" name="postalCode"> <br>',
            'submit' => '<input type="submit"> <br>',
            'endForm' => '</form>'
        ];
        return $form;
    }

    public function rootAddUserForm(){
        $form = [
            'form' => '<form method="post"> <br>',
            'name' => 'pseudo :<input type="text" name="name"> <br>',
            'passwd' => 'mot de passe :<input type="password" name="password"> <br>',
            'passwdCheck' => 'réentrer mot de passe :<input type="password"> <br>',
            'prenom' => 'prenom :<input type="text" name="prenom"> <br>',
            'nom' => 'nom :<input type="text" name="nom"> <br>',
            'tel' => 'telephone :<input type="tel" name="tel"> <br>',
            'mail' => 'mail :<input type="email" name="mail"> <br>',
            'adresse' => 'adresse :<input type="text" name="adresse"> <br>',
            'postalCode' => 'Code Postal :<input type="int" name="postalCode"> <br>',
            'type' => 'type :<table><tr><td>user</td><td>prof</td></tr><tr><td><input type="checkbox" name="type" value="user"></td><td><input type="checkbox" name="type" value="prof"></td></tr></table>',
            'submit' => '<input type="submit"> <br>',
            'endForm' => '</form>'
        ];
        return $form;
    }

    public function logUserForm(){
        $form = [
            'form' => '<form method="post">',
            'name' => 'pseudo :<input type="text" name="name"> <br>',
            'passwd' => 'mot de passe :<input type="password" name="password"> <br>',
            'connect' => '<input type="submit" value="connection">',
            'endForm' => '</form>'
        ];
        return $form;
    }

    public function getUnlogInterface(){
        $response = [
            'connect' => '<li class="listLogMenu"><a href="/RenduFin/web/index.php?p=user_log" class="ListLogLink">Connexion</a></li>',
            'insciption' => '<li class="listLogMenu"><a href="/RenduFin/web/index.php?p=user_add" class="ListLogLink">Inscription</a></li>'
        ];
        return $response;
    }

    public function getLogInterface(){
        $response = [
            'disconnect' => '<li class="ListDelogMenu"><a href="/RenduFin/web/index.php?p=user_logout" class="listDelogLink">Deconnection</a></li>',
            'destruct' => '<li class="ListDelogMenu"><a href="/RenduFin/web/index.php?p=user_delete" class="listDelogLink">Supprimer votre compte</a></li>',
            'showInfo' => '<li class="ListDelogMenu"><a href="/RenduFin/web/index.php?p=user_show" class="listDelogLink">Informations du compte</a></li>',
            'modify' => '<li class="ListDelogMenu"><a href="/RenduFin/web/index.php?p=user_modify">modifier votre compte</a></li>',
            'viewMyCours' => '<li class="ListDelogMenu"><a href="/RenduFin/web/index.php?p=user_cours">Voir les cours auquel vous êtes inscrit</a></li>',
            'viewCours' => '<li class="ListDelogMenu"><a href="/RenduFin/web/index.php?p=cours_show">voir les cours programmés</a></li> ',
            'viewAbo' => '<li class="ListDelogMenu"><a href="/RenduFin/web/index.php?p=user_showAbo">voir les abonnements</a></li>',
            'getAbo' => '<li class="ListDelogMenu"><a href="/RenduFin/web/index.php?p=user_getAbo">Souscrire un abonnement</a></li>',
            'manageAbo' => '<li class="ListDelogMenu"><a href="/RenduFin/web/index.php?p=user_manageAbo">gerer votre abonnement</a></li>',
            'return' => '<li class="ListDelogMenu"><a href="/RenduFin/web/index.php?p=home_login">retour</a>'
        ];
        return $response;
    }

    public function rootLogInInterface(){
        $response = [
            'disconnect' => '<li class="ListDelogMenu"><a href="/RenduFin/web/index.php?p=user_logout" class="listDelogLink">Deconnection</a></li>',
            'userIngo' => '<li class="ListDelogMenu"><a href="/RenduFin/web/index.php?p=user_list">liste utilisateurs</a></li>',
            'deleteUser' => '<li class="ListDelogMenu"><a href="/RenduFin/web/index.php?p=root_delete">supprimer un utilisateur</a></li>',
            'showInfo' => '<li class="ListDelogMenu"><a href="/RenduFin/web/index.php?p=user_show" class="listDelogLink">Informations du compte</a></li>',
            'addUser' => '<li class="ListDelogMenu"><a href="/RenduFin/web/index.php?p=root_add" class="listDelogLink">Ajouter un utilisateur</a></li> ',
            'modifyUser' => '<li class="ListDelogMenu"><a href="/RenduFin/web/index.php?p=root_modify">modifier infos utilisateurs</a></li>',
            'viewCoursFollowers' => '<li class="ListDelogMenu"><a href="/RenduFin/web/index.php?p=prof_followers">voir les participants</a></li>',
            'viewCours' => '<li class="ListDelogMenu"><a href="/RenduFin/web/index.php?p=cours_show">voir les cours programmés</a></li> ',
            'addCours' => '<li class="ListDelogMenu"><a href="/RenduFin/web/index.php?p=cours_add">ajouter un cours</a></li> ',
            'deleteCours' => '<li class="ListDelogMenu"><a href="/RenduFin/web/index.php?p=cours_delete">supprimer un cours</a></li> ',
            'manageAbo' => '<li class="ListDelogMenu"><a href="/RenduFin/web/index.php?p=user_manageAbo">gerer les abonnements</a></li>',
            'return' => '<li class="ListDelogMenu"><a href="/RenduFin/web/index.php?p=home_login">retour</a>'
        ];
        return $response;
    }
    public function profLogInInterface(){
        $response = [
            'disconnect' => '<li class="ListDelogMenu"><a href="/RenduFin/web/index.php?p=user_logout" class="listDelogLink">Deconnection</a></li>',
            'destruct' => '<li class="ListDelogMenu"><a href="/RenduFin/web/index.php?p=user_delete" class="listDelogLink">Supprimer votre compte</a></li>',
            'modify' => '<li class="ListDelogMenu"><a href="/RenduFin/web/index.php?p=user_modify">modifier votre compte</a></li>',
            'showInfo' => '<li class="ListDelogMenu"><a href="/RenduFin/web/index.php?p=user_show" class="listDelogLink">Informations du compte</a></li>',
            'viewMyCours' => '<li class="ListDelogMenu"><a href="/RenduFin/web/index.php?p=prof_show">Voir les cours auquel vous êtes inscrit</a></li>',
            'viewCours' => '<li class="ListDelogMenu"><a href="/RenduFin/web/index.php?p=cours_show">voir les cours programmés</a></li> ',
            'viewCoursFollowers' => '<li class="ListDelogMenu"><a href="/RenduFin/web/index.php?p=prof_followers">voir les participants</a></li>',
            'addCours' => '<li class="ListDelogMenu"><a href="/RenduFin/web/index.php?p=cours_add">ajouter un cours</a></li> ',
            'deleteCours' => '<li class="ListDelogMenu"><a href="/RenduFin/web/index.php?p=cours_delete">supprimer un cours</a></li> ',
            'return' => '<li class="ListDelogMenu"><a href="/RenduFin/web/index.php?p=home_login">retour</a>'
        ];
        return $response;
    }

    public function deleteUser(){
        $response = [
            'form' => '<form method="post">',
            'input' => 'nom :<input type="text" name="name">',
            'submit' =>'<input type="submit">',
            'endForm' =>'</form>'
        ];
        return $response;
    }

    public function modifyUsers(){
        $response = [
            'form' => '<form method="post">',
            'password' => 'Changer password :<input type="radio" value="password" name="modifications">',
            'adresse' => 'Changer adresse :<input type="radio" value="adresse" name="modifications">',
            'mail' => 'Changer mail :<input type="radio" value="mail" name="modifications">',
            'submit' => '<input type="submit" value="Modifier">'
        ];
        return $response;
    }

    public function modifyRoot(){
        $response = [
            'form' => '<form method="post">',
            'name' => 'user name :<input type="text" name="name">',
            'password' => 'Changer password :<input type="radio" value="password" name="modifications">',
            'adresse' => 'Changer adresse :<input type="radio" value="adresse" name="modifications">',
            'mail' => 'Changer mail :<input type="radio" value="mail" name="modifications">',
            'submit' => '<input type="submit" value="Modifier">'
        ];
        return $response;
    }

    public function modifyPwd(){
        $response = [
            'form' => '<form method="post">',
            'password' => 'mot de passe :<input type="password" name="password">',
            'passwordCheck' => 'mot de passe :<input type="password" name="passwordCheck">',
            'submit' => '<input type="submit" value="Changer">',
            'endForm' => '</form>'
        ];
        return $response;
    }

    public function modifyAdress(){
        $response = [
            'form' => '<form method="post">',
            'adresse' => 'adresse :<input type="text" name="adresse">',
            'postalCode' => 'code Postal :<input name="postalCode">',
            'submit' => '<input type="submit" value="Changer">',
            'endForm' => '</form>'
        ];
        return $response;
    }
    public function modifyMail(){
        $response = [
            'form' => '<form method="post">',
            'mail' => 'mail :<input type="text" name="mail">',
            'submit' => '<input type="submit" value="Changer">',
            'endForm' => '</form>'
        ];
        return $response;
    }

    public function showCoursBySubject(){
        $response = [
            'form' => '<form method="post">',
            'input' => '<select name="matiere"><option value="_Cook it Yourself">_Cook it Yourslef</option><option value="_Plant it Yourself">_Plant it Yourself</option><option value="_Tale it Yourslef">_Tale it Yourself</option><option value="_Make it Yourself">_Make it Yourself</option></select><option value="all">Toutes les catégories</option></select>',
            'submit' => '<input type="submit" value="voir">',
            'endForm' => '</form>'
        ];
        return $response;
    }

    public function addCours(){
        $response = [
            'form' => '<form method="post">',
            'matiere' => 'matiere :<select name="matiere"><option value="_Cook it Yourself">_Cook it Yourslef</option><option value="_Plant it Yourself">_Plant it Yourself</option><option value="_Tale it Yourslef">_Tale it Yourself</option><option value="_Make it Yourself">_Make it Yourself</option></select><br>',
            'prof_id' => 'prof id :<input type="number" name="prof"><br>',
            'debut' => 'debut :<input type="time" name="debut"><br>',
            'fin' => 'fin :<input type="time" name="fin"><br>',
            'date' => 'date :<input type="date" name="date"><br>',
            'submit' => '<input type="submit">',
            'endForm' => '</form>'
        ];
        return $response;
    }

    public function deleteCours(){
        $response = [
            'form' => '<form method="post">',
            'coursId' => '<input type="number" name="id">',
            'submit' => '<input type="submit">',
            'endForm' => '</form>'
        ];
        return $response;
    }

    public function AddAbonnement(){
        $response = [
            'form' => '<form method="post">',
            'nom' => 'nom :<input type="text" name="name"> <br>',
            'valeur' => 'valeur :<input name="valeur">',
            'submit' => '<input type="submit">',
            'endForm' => '</form>'
        ];
        return $response;
    }

    public function deleteAbo(){
        $response = [
            'form' => '<form method="post">',
            'nom' => 'nom :<input type="text" name="name">',
            'submit' => '<input type="submit">',
            'endform' => '</form>'
        ];
        return $response;
    }

    public function userGetAbo(){
        $response= [
            'form' => '<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">',
            'cmd/hosted' => '<input type="hidden" name="cmd" value="_s-xclick"><input type="hidden" name="hosted_button_id" value="3683ZHD6U2JM4">',
            'table' => '<table><tr><td><input type="hidden" name="on0" value=""></td></tr><tr><td><select name="os0"><option value="basic">basic : 30,00 EUR - mensuel</option><option value="moyen">moyen : 50,00 EUR - mensuel</option><option value="avance">avance : 70,00 EUR - mensuel</option></select> </td></tr></table>',
            'code' => '<input type="hidden" name="currency_code" value="EUR"><input type="image" src="https://www.paypalobjects.com/fr_FR/FR/i/btn/btn_subscribe_SM.gif" border="0" name="submit" alt="PayPal - la solution de paiement en ligne la plus simple et la plus sécurisée !"><img alt="" border="0" src="https://www.paypalobjects.com/fr_FR/i/scr/pixel.gif" width="1" height="1">',
            'endForm' => '</form>'
        ];
        return $response;
    }

    public function getId(){
        $response = [
            'form' => '<form method="post">',
            'id' => '<input type="number" name="id">',
            'submit' => '<input type="submit">',
            'endform' => '</form>'
        ];
        return $response;
    }

    public function cancelAbo(){
        $response = [
            'link' => '<A HREF="https://www.paypal.com/cgi-bin/webscr?cmd=_subscr-find&alias=EJ6YNCWWLZ4KU"><IMG SRC="https://www.paypalobjects.com/fr_FR/FR/i/btn/btn_unsubscribe_LG.gif" BORDER="0"></A>'
        ];
        return $response;
    }
}