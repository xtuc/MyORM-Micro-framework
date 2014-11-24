<?php
/**
 * Configuration
 *
 * For more info about constants please @see http://php.net/manual/en/function.define.php
 * If you want to know why we use "define" instead of "const" @see http://stackoverflow.com/q/2447791/1114320
 */

/**
 * Configuration for: Error reporting
 * Useful to show every little problem during development, but only show hard errors in production
 */
error_reporting(E_ALL);
ini_set("display_errors", 1);

/**
 * Configuration for: Project URL
 * Put your URL here, for local development "127.0.0.1" or "localhost" (plus sub-folder) is fine
 */
define("app", "application/");
define("libs", app . "libs/");

/**
 * Define URL
 */
$dir = str_replace("index.php", "", $_SERVER["SCRIPT_NAME"]);
define('URL', "http://" . $_SERVER["HTTP_HOST"] . $dir);

/**
 * Configuration for: Database
 * This is the place where you define your database credentials, database type etc
 */

define('DB_TYPE', 'mysql');
define('DB_HOST', 'xtuc.fr');
define('DB_NAME', 'ORM_test_unit');
define('DB_USER', 'root');
define('DB_PASS', '2rIhIzVpluAwJGslw2Vs'); 

/**
 * Configuration for: Views
 *
 * PATH_VIEWS is the path where your view files are. Don't forget the trailing slash!
 * PATH_VIEW_FILE_TYPE is the ending of your view files, like .php, .twig or similar.
 */
define('PATH_VIEWS', app . 'views/');
define('PATH_VIEW_FILE_TYPE', '.twig');

include(app . "config/orm_config.php");