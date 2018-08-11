<?php

require_once '../../../vendor/autoload.php';

define('APP_ROOT', dirname(__DIR__));

use lmarqs\Spa\Core\Application;

$application = Application::getInstance();

$application->init();

$application->run();
