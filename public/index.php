<?php

<<<<<<< Updated upstream
=======

>>>>>>> Stashed changes
use Controller\FrontController;

use Tracy\Debugger;

<<<<<<< Updated upstream
require_once dirname(__DIR__) . '/vendor/autoload.php';

Debugger::enable();

$frontController
=======
// Loads Composer autoload
require_once '../vendor/autoload.php';
Debugger::enable();
$frontController = new FrontController();
$frontController->run();
>>>>>>> Stashed changes
