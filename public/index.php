<?php

use Controller\FrontController;

use Tracy\Debugger;

require_once dirname(__DIR__) . '/vendor/autoload.php';

Debugger::enable();

$frontController