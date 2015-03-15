<?php

session_start();

// load application config (error reporting etc.)
require 'application/config/config.php';

/**
 * Twig Load and init
 */
require libs . "Twig/Autoloader.php";
Twig_Autoloader::register();

/**
 * Loading & init ORM
 */
require libs . "ORM/__autoload.php";
ORMAutoloader::RegisterAutoloader();
new ORM\Exception\Exception;
/*require( libs . 'php_error.php' );
    \php_error\reportErrors();*/

// load application class
require libs . "application.php";
require libs . "controller.php";

// start the application
$app = new Application();

?>