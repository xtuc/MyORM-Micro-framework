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
if(isset($_SERVER["HTTP_HOST"]))
{
	define("CLI", FALSE);
	$dir = str_replace("index.php", "", $_SERVER["SCRIPT_NAME"]);
	define('URL', "http://" . $_SERVER["HTTP_HOST"] . $dir);
}
else
{
	define("CLI", TRUE);
	$dir = getcwd();
}

/**
 * Configuration for: Database
 * This is the place where you define your database credentials, database type etc
 */

define('DB_TYPE', 'mysql');

define('DB_HOST', 'localhost');
define('DB_NAME', 'testorm');
define('DB_USER', 'root');
define('DB_PASS', 'ytz2014fr');

/**
 *  If u want to have a specific connection chain for Write
 *  
 * define('DBW_TYPE', 'mysql');
 * define('DBW_HOST', 'xtuc.fr');
 * define('DBW_NAME', 'devintranetffjv');
 * define('DBW_USER', 'devintranetffjv');
 * define('DBW_PASS', 'devintranetffjv');
 * define('TRANSACTIONW_MODE', 'IfDefined');
 * define('SQLW_DEBUG', 'IfDefined');
*/

/**
 * Configuration for: Views
 *
 * PATH_VIEWS is the path where your view files are. Don't forget the trailing slash!
 * PATH_VIEW_FILE_TYPE is the ending of your view files, like .php, .twig or similar.
 */
define('PATH_VIEWS', app . 'views/');
define('PATH_VIEW_FILE_TYPE', '.twig');

include(app . "config/orm_config.php");
