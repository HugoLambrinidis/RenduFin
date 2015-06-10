<?php

namespace Website\Model;

use WebSite\Controller\AbstractBaseController;

class RootManager extends AbstractBaseController{

    public static $conn;

    public function __construct(){
        self::$conn = $this->getConnection();
    }

    public function updateUsersPasswd($name,$info){
        $request = self::$conn->prepare('UPDATE users SET user_pwd = :info WHERE user_name = :name');
        $request->execute([
            'name' => $name,
            'info' => sha1($info)
        ]);
    }

    public function updateUserAdress($name,$adresse,$postalCode){
        $request = self::$conn->prepare('UPDATE users SET adresse = :adresse, postalCode = :postalCode WHERE user_name = :name');
        $request->execute([
            'name' => $name,
            'adresse' => $adresse,
            'postalCode' => $postalCode
        ]);
    }

    public function deleteUser($name){
        $request = self::$conn->prepare('DELETE FROM users WHERE user_name = :name');
        $request->execute(array('name'=>$name));
    }

    public function updateUsersMail($name,$mail){
        $request = self::$conn->prepare('UPDATE users SET mail = :mail WHERE user_name = :name');
        $request->execute([
            'name' => $name,
            'mail' => $mail
        ]);
    }
}