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
        $statement = self::$conn->prepare('INSERT INTO users (user_name, user_pwd,prenom,nom,telephone,mail,adresse,postalCode,type) VALUES (:name, :password, :prenom, :nom, :telephone, :mail, :adresse, :postalCode, :type)');
        $statement->execute([
            'name' => $name,
            'password' => sha1($password),
            'prenom' => $prenom,
            'nom' => $nom,
            'telephone' => $telephone,
            'mail' => $mail,
            'adresse' => $adresse,
            'postalCode' => $postalCode,
            'type' => 'user'
        ]);
    }

    public function rootAddUser($name,$password,$prenom,$nom,$telephone,$mail,$adresse,$postalCode,$type){
        $statement = self::$conn->prepare('INSERT INTO users (user_name, user_pwd,prenom,nom,telephone,mail,adresse,postalCode,type) VALUES (:name, :password, :prenom, :nom, :telephone, :mail, :adresse, :postalCode, :type)');
        $statement->execute([
            'name' => $name,
            'password' => sha1($password),
            'prenom' => $prenom,
            'nom' => $nom,
            'telephone' => $telephone,
            'mail' => $mail,
            'adresse' => $adresse,
            'postalCode' => $postalCode,
            'type' => $type
        ]);
    }

    public function logUser($name,$password){
        $connect = self::$conn->prepare('SELECT user_id, user_name, user_pwd, type FROM users WHERE user_name = :name AND user_pwd = :password');
        $connect->execute(['name' => $name, 'password' => sha1($password)]);
        $session = $connect->fetchall();
        return $session;
    }

    public function showUser($name){
        $statement = self::$conn->prepare('SELECT user_id,user_name,prenom,nom,telephone,mail,adresse,postalCode,type FROM users WHERE user_name = :name');
        $statement->execute(['name'=>$name]);
        $user = $statement->fetchAll();
        return $user;
    }

    public function deleteUser($name){
        $request = self::$conn->prepare('DELETE FROM users WHERE user_name = :name');
        $request->execute(array('name'=>$name));
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

    public function updateUsersMail($name,$mail){
        $request = self::$conn->prepare('UPDATE users SET mail = :mail WHERE user_name = :name');
        $request->execute([
            'name' => $name,
            'mail' => $mail
        ]);
    }

    public function updateUsersType($name,$type){
        $request = self::$conn->prepare('UPDATE users SET type = :type WHERE user_name = :name');
        $request->execute([
            'name' => $name,
            'type' => $type
        ]);
    }

    public function showUserAtCours($id){
        $statement = self::$conn->prepare('SELECT matieres, date, user_name FROM cours_users p INNER JOIN cours c ON c.cours_id = p.id_cours INNER JOIN users u ON u.user_id = p.user_id WHERE c.cours_id = :id');
        $statement->execute(['id' => $id]);
        $response = $statement->fetchAll();
        return $response;
    }

    public function showCoursForUser($id){
        $statement = self::$conn->prepare('SELECT matieres, date, cours_id FROM cours_users p INNER JOIN cours c ON c.cours_id = p.id_cours INNER JOIN users u ON u.user_id = p.user_id WHERE u.user_id = :id');
        $statement->execute(['id' => $id]);
        $response = $statement->fetchAll();
        return $response;
    }

    public function inscriptionCours($id_cours, $id_users){
        $statement = self::$conn->prepare('INSERT INTO cours_users (id_cours, user_id) VALUES (:id_cours,:id_users)');
        $statement->execute([
            'id_cours' => $id_cours,
            'id_users' => $id_users
        ]);
    }

    public function getUserId($name){
        $statement = self::$conn->prepare('SELECT user_id FROM users WHERE user_name = :name');
        $statement->execute(['name' => $name]);
        $response = $statement->fetchAll();
        return $response;
    }

    public function showAbo(){
        $statement = self::$conn->prepare('SELECT nom_abonnement,valeur FROM abonnements');
        $statement->execute();
        $response = $statement->fetchAll();
        return $response;
    }

    public function getAbo($idUser,$idAbo){
        $statement = self::$conn->prepare('INSERT INTO abo_users(id_user,abo_id) VALUES (:idUser, :idAbo)');
        $statement->execute([
            'idUser' => $idUser,
            'idAbo' => $idAbo
        ]);
    }
}