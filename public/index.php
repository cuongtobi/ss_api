<?php
require '../bootstrap.php';

use App\Controller\UserController;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$routes = array('users');
$id = null;

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);

if (!isset($uri[1]) || empty($uri[1]) || !in_array($uri[1], $routes)) {
    header("HTTP/1.1 404 Not Found");
    exit;
}

if (isset($uri[2]) && !empty($uri[2])) {
    $id = $uri[2];
}

$controllerClass = 'App\\Controller\\' . ucfirst(rtrim($uri[1], 's')) . 'Controller';

if (!class_exists($controllerClass)) {
    header("HTTP/1.1 404 Not Found");
    exit;
}

$requestMethod = $_SERVER["REQUEST_METHOD"];
$controller = new $controllerClass($requestMethod, $id);
$controller->handle();
