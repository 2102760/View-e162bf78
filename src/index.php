<?php

$subFolder = "/Routing-55c68e3b/src/"; // Leave bank for none
$route = str_replace($subFolder, "", $_SERVER["REQUEST_URI"]);
$routeArray = explode('/', $route);

if (!isset($routeArray[0])) {
    http_response_code(404);
    die('Controller not specified');
}

if (!isset($routeArray[1])) {
    http_response_code(404);
    die('Method not specified');
}

$controller = $routeArray[0];
$method = $routeArray[1];

$controllerPath = 'controllers/' . strtolower($controller) . 'Controller.php';

if (!file_exists($controllerPath)) {
    http_response_code(404);
    die('Controller not found');
}

require_once($controllerPath);
$controllerClass = new $controller;

if (!method_exists($controllerClass, $method)) {
    http_response_code(404);
    die('Method not found');
}

$controllerClass->$method();

echo "Controller: {$controller}<br>";
echo "Method: {$method}<br>";
?>