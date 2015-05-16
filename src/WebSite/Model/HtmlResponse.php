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
            'name' => '<input type="text" name="name"> <br>',
            'passwd' => '<input type="password" name="password"> <br>',
            'connect' => '<input type="submit" value="connection">',
            'endForm' => '</form>'
        ];
        return $form;
    }

    public function getUnlogInterface(){
        $response = [
            'menu' => '<ul class="logMenu">',
            'connect' => '<li class="listLogMenu"><a href="/RenduFin/web/index.php?p=user_log" class="ListLogLink">Connection</a></li>',
            'insciption' => '<li class="listLogMenu"><a href="/RenduFin/web/index.php?p=user_add" class="ListLogLink">Inscription</a></li>',
            'endul' => '</ul>'
        ];
        return $response;
    }

    public function getLogInterface(){
        $response = [
            'menu' => '<ul class="delogMenu>"',
            'disconnect' => '<li class="ListDelogMenu"><a href="/RenduFin/web/index.php?p=user_logout" class="listDelogLink">Deconnection</a></li>',
            'destruct' => '<li class="ListDelogMenu"><a href="/RenduFin/web/index.php?p=user_delete" class="listDelogLink">Supprimer votre compte</a></li>',
            'showInfo' => '<li class="ListDelogMenu"><a href="/RenduFin/web/index.php?p=user_show" class="listDelogLink">Informations du compte</a></li>',
            'endul' => '</ul>'
        ];
        return $response;
    }

    public function rootLogInInterface(){
        $response = [
            'menu' => '<ul class="delogMenu>"',
            'disconnect' => '<li class="ListDelogMenu"><a href="/RenduFin/web/index.php?p=user_logout" class="listDelogLink">Deconnection</a></li>',
            'userIngo' => '<li class="ListDelogMenu"><a href="/RenduFin/web/index.php?p=user_list">liste utilisateurs</a></li>',
            'deleteUser' => '<li class="ListDelogMenu"><a href="/RenduFin/web/index.php?p=root_delete">supprimer un utilisateur</a></li>',
            'showInfo' => '<li class="ListDelogMenu"><a href="/RenduFin/web/index.php?p=user_show" class="listDelogLink">Informations du compte</a></li>',
            'addUser' => '<li class="ListDelogMenu"><a href="/RenduFin/web/index.php?p=root_add" class="listDelogLink">Ajouter un utilisateur</a></li> ',
            'endul' => '</ul>'
        ];
        return $response;
    }

    public function deleteUser(){
        $response = [
            'form' => '<form method="post">',
            'input' => '<input type="text" name="name">',
            'submit' =>'<input type="submit">',
            'endForm' =>'</form>'
        ];
        return $response;
    }
}