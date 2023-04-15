<?php

// Loads the composer autoload if it exists, otherwise load the classes manually.
$composer_autoload = __DIR__ . '/../vendor/autoload.php';

if (file_exists($composer_autoload))
{
	require_once $composer_autoload;
}
else
{
	require_once 'CambioReal.php';
	require_once 'Config.php';
	require_once 'Http/Request.php';
	require_once 'Action/AbstractAction.php';
	require_once 'Action/Factory.php';
	require_once 'Action/Validator.php';
	require_once 'Action/Request.php';
	require_once 'Action/Cancel.php';
	require_once 'Action/Get.php';
	require_once 'Action/Simulator.php';
}
