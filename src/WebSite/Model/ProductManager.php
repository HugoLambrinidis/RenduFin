<?php

namespace Website\Model;

use WebSite\Controller\AbstractBaseController;

class ProductManager extends AbstractBaseController
{

    public static $conn;

    public function __construct()
    {
        self::$conn = $this->getConnection();
    }

    public function addRootAbonnement($name,$valeur){
        $request = self::$conn->prepare('INSERT INTO abonnements (nom_abonnement, valeur) VALUES (:nom_abo, :valeur)');
        $request->execute([
            'nom_abo' => $name,
            'valeur' => $valeur
        ]);
    }

    public function deleteRootAbo($name){
        $request = self::$conn->prepare('DELETE FROM abonnements WHERE nom_abonnement = :name');
        $request->execute(['name' => $name]);
    }

    public function showUserByAbo($id){
        $request = self::$conn->prepare('SELECT nom_abonnement,user_name FROM abo_users p INNER JOIN users u ON u.user_id = p.id_user INNER JOIN abonnements a ON a.abo_id = p.abo_id WHERE a.abo_id = :id');
        $request->execute(['id' => $id]);
        $response = $request->fetchAll();
        return $response;
    }

    public function deleteUsersAbo($id){
        $statement = self::$conn->prepare('DELETE FROM abo_users WHERE id_user = :id');
        $statement->execute(['id' => $id]);
    }

    public function showUsersAbo($id){
        $statement = self::$conn->prepare('SELECT user_name,nom_abonnement,valeur FROM abo_users p INNER JOIN abonnements a ON a.abo_id = p.abo_id INNER JOIN users u ON u.user_id = p.id_user WHERE user_id = :id');
        $statement->execute(['id' => $id]);
        $response = $statement->fetchAll();
        return $response;
    }

    public function getUserAbo($id){
        $statement = self::$conn->prepare('SELECT abo_id FROM abo_users WHERE id_user = :id');
        $statement->execute(['id'=>$id]);
        $response = $statement->fetchAll();
        return $response;
    }

    public function showAbo(){
        $statement = self::$conn->prepare('SELECT nom_abonnement,valeur,description FROM abonnements');
        $statement->execute();
        $response = $statement->fetchAll();
        return $response;
    }

    public function showIdAbo(){
        $statement = self::$conn->prepare('SELECT abo_id,nom_abonnement,valeur FROM abonnements');
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