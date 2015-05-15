<?php

namespace WebSite\Model;


use Website\Controller\AbstractBaseController;

class UserManager extends AbstractBaseController {

    public static $conn;

    public function __construct(){
        self::$conn = $this->getConnection();
    }

    public function getUserList(){
        $statement = self::$conn->prepare('SELECT * FROM users');
        $statement->execute();
        $users = $statement->fetchAll();
        return $users;
    }

    public function getUserByName($name){
        $statement = self::$conn->prepare('SELECT COUNT(`user_name`) from users WHERE `user_name` = :name');
        $statement->execute([
            'name' => $name
        ]);
        $users = $statement->fetchAll();
        return $users;
    }

    public function addUser($name,$password,$prenom,$nom,$telephone,$mail,$adresse,$postalCode){
        $statement = self::$conn->prepare('INSERT INTO users (user_name, user_pwd,prenom,nom,telephone,mail,adresse,postalCode) VALUES (:name, :password, :prenom, :nom, :telephone, :mail, :adresse, :postalCode)');
        $statement->execute([
            'name' => $name,
            'password' => sha1($password),
            'prenom' => $prenom,
            'nom' => $nom,
            'telephone' => $telephone,
            'mail' => $mail,
            'adresse' => $adresse,
            'postalCode' => $postalCode
        ]);
    }

    public function logUser($name,$password){
        $connect = self::$conn->prepare('SELECT user_id, user_name, user_pwd FROM users WHERE user_name = :name AND user_pwd = :password');
        $connect->execute(['name' => $name, 'password' => sha1($password)]);
        $session = $connect->fetchall();
        return $session;
    }

    public function showUser($name){
        $statement = self::$conn->prepare('SELECT user_name,prenom,nom,telephone,mail,adresse,postalCode FROM users WHERE user_name = :name');
        $statement->execute(['name'=>$name]);
        $user = $statement->fetchAll();
        return $user;
    }

    public function deleteUser($name){
        $request = self::$conn->prepare('DELETE FROM users WHERE user_name = :name');
        $request->execute(array('name'=>$name));
    }

}