<?php

require __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\Yaml\Yaml;
use Website\Model\MessageFlash;

$session = new MessageFlash();
$session->printMessageFlash();
$routes = Yaml::parse(file_get_contents(__DIR__.'/../app/config/routing.yml'));
if(!empty($_GET['p'])){
    $page = $_GET['p'];
} else {
    if(isset($_SESSION)){
        $page = 'login_home';
    }
    else{
        $page = 'home';
    }

}

if (!empty($routes[$page]['controller'])) {
    $current_route = explode(':', $routes[$page]['controller']);
} else {
    throw new Exception('add routing config for '.$page.' in routing.yml');
}

$controller_class = $current_route[0];
$action_name = $current_route[1];

$controller = new $controller_class();

$request['request'] = &$_POST;
$request['query'] = &$_GET;
$request['session'] = &$_SESSION;
$response = $controller->$action_name($request);

if (!empty($response['redirect_to'])) {
    header('Location: ' . $response['redirect_to']);
} else if (!empty($response['view'])) {

    $loader = new Twig_Loader_Filesystem('../src/WebSite/View');
    $twig = new Twig_Environment($loader);
    $twigVariables = $response[$page];
    $twigRoutes = $response['view'];
    echo $twig->render($twigRoutes, array($page => $twigVariables));

} else {
    throw new Exception('your action "'.$page.'" do not return a correct response array, should have "view" or "redirect_to"');
}
