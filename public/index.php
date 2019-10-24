<?php


use Controller\Router;
//use Tracy\Debugger; only for dev


require_once '../vendor/autoload.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

//Debugger::enable(); only for dev

$router = new Router();
$router->run();

