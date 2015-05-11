<?php
namespace Website\Controller;
use Symfony\Component\Yaml\Parser;
abstract class AbstractBaseController {
    public function getConnection() {
        $config = new \Doctrine\DBAL\Configuration();
        $yaml = new Parser();
        $routes = $yaml->parse(file_get_contents('../app/config/config-dev.yml'));
        $connectionParams = [
            'dbname' => $routes['doctrine']['database'],
            'user' => $routes['doctrine']['username'],
            'password' => $routes['doctrine']['password'],
            'host' => $routes['doctrine']['host'],
            'driver' => $routes['doctrine']['driver'],
        ];
        return $conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams, $config);
    }
}