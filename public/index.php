<?php


use Controller\FrontController;

use Tracy\Debugger;


require_once '../vendor/autoload.php';


Debugger::enable();

$frontController = new FrontController();
$frontController->run();

