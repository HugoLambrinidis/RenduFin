<?php

namespace Website\Controller;

use Doctrine\DBAL;

class UserController{

    public function listUserAction($request){
        $config = new \Doctrine\DBAL\Configuration();
        $connectionParams = array(
            'dbname' => 'Transversaldb',
            'user' => 'user',
            'password' => 'secret',
            'host' => 'localhost',
            'driver' => 'pdo_mysql'
        );

        $conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams, $config);
        $statement = $conn->prepare('SELECT * from user');
        $statement->execute();
        $users = $statement->fetchAll();

        return [
            'view' => 'WebSite/View/user/listUser.html.php',
            'users'=> $users
        ];
    }
    public function addUser($request){
        if($request['request']){
            return [
                'redirect_to' => 'http://.......'
            ];
        }
        return [
            'view' => 'WebSite/View/user/listUser.html.php',
            'users'=> $users
        ];
    }
    public function deleteUser($request){
        return [
            'redirect_to' => 'http://.......'
        ];
    }
    public function logUser($request){
        if($request['request']){

        }
        return [
            'redirect_to' => 'http://.......'
        ];
    }
}