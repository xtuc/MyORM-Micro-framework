<?php

session_start();
ini_set('display_errors', E_ALL);

// load application config (error reporting etc.)
require 'application/config/config.php';

global $languages;
require libs . "Languages.php"; // Require custom Slim component Languages.php : traductions

$languages = new Languages();

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

// load application class
require libs . "application.php";
require libs . "controller.php";

// start the application
$app = new Application();
?>