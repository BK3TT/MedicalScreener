<?php
header('Access-Control-Allow-Origin: *');

require_once('database/dbAccess.php');
require_once('controllers/mainController.php');

$apiCallVariables = explode('/', trim($_SERVER['REQUEST_URI'], '/'));

if(count($apiCallVariables) > 6) {
    header($_SERVER['SERVER_PROTOCOL'] . " 400 Bad Request");
    die();
}

$controllerName = isset($apiCallVariables['1']) ? $apiCallVariables['1'] . 'Controller': "";
$functionCall = isset($apiCallVariables['2']) ? $apiCallVariables['2'] : "";
$functionVal = isset($apiCallVariables['3']) ? $apiCallVariables['3'] : "";

if(!file_exists('controllers/'.$controllerName.'.php')) {
    header($_SERVER['SERVER_PROTOCOL']." 404 Not found.");
    die();
}

require('controllers/'.$controllerName.'.php');
$controller = new $controllerName();
$controller->DB = DBAccess::DBAccess();
$requestMethod = $_SERVER['REQUEST_METHOD'];

switch ($requestMethod) {
    case 'GET':
    case 'POST':
    {
        if($requestMethod == 'GET')  $controller->_populate($_GET);
        if($requestMethod == 'POST') $controller->_populate($_POST);

        if($functionVal !== "") {
            $controller->$functionCall($functionVal);
        } else {
            $controller->$functionCall();
        }
    }
}

?>