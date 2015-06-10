<?php
namespace Website\Controller;


use Symfony\Component\Yaml\Parser;
use WebSite\Model\UserManager;
use WebSite\Model\ProfsManager;
use Website\Model\RootManager;
use WebSite\Model\ProductManager;


abstract class AbstractBaseController {

    protected function getUserManager(){
        return new UserManager($this->getConnection());
    }

    protected function getProfManager(){
        return new ProfsManager($this->getConnection());
    }

    protected function getRootManager(){
        return new RootManager($this->getConnection());
    }

    protected function getProductManager(){
        return new ProductManager($this->getConnection());
    }

    public function getConnection() {
        $config = new \Doctrine\DBAL\Configuration();
        $yaml = new Parser();
        $routes = $yaml->parse(file_get_contents('../app/config/config_dev.yml'));
        $connectionParams = [
            'dbname' => $routes['doctrine']['database'],
            'user' => $routes['doctrine']['user'],
            'password' => $routes['doctrine']['password'],
            'host' => $routes['doctrine']['host'],
            'driver' => $routes['doctrine']['driver'],
        ];
        return $conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams, $config);
    }
}