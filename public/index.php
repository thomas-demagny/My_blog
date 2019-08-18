<?php


use Controller\FrontController;

use Tracy\Debugger;


require_once '../vendor/autoload.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

Debugger::enable();

$frontController = new FrontController();
$frontController->run();

