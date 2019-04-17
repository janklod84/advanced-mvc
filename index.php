<?php 

/*
 | ------------------------------------------------------------
 |               CONSTANTES DEFINITIONS
 | ------------------------------------------------------------
*/

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__FILE__));


/*
 | ------------------------------------------------------------
 |          LOAD CONFIGURATION AND HELPER FUNCTION
 | ------------------------------------------------------------
*/
require_once(ROOT . DS . 'config' . DS . 'config.php');
require_once(ROOT . DS . 'app' . DS . 'lib' . DS . 'helpers' . DS . 'functions.php');


/*
 | ------------------------------------------------------------
 |          AUTOLOAD CLASSES
 | ------------------------------------------------------------
*/

require_once 'vendor/autoload.php';


/*
 | ------------------------------------------------------------
 |                    STARTING SESSION
 | ------------------------------------------------------------
*/

session_start();



/*
 | ------------------------------------------------------------
 |              GET URL
 |              Exemple this path '/users/register/567'
 |              will be trim left by '/' and we obtain  'users/register/567'
 | ------------------------------------------------------------
*/

 $url = isset($_SERVER['PATH_INFO']) ? explode('/', ltrim($_SERVER['PATH_INFO'], '/')) : [];


/*
 | ------------------------------------------------------------
 |          GET INSTANCE OF DATABASE
 | ------------------------------------------------------------
*/

$db = DB::getInstance();


/*
 | ------------------------------------------------------------
 |          START ROUTING [ ROUTE THE REQUEST ]
 |          $url from index.php [it's global variable] $_SERVER['PATH_INFO']
 | ------------------------------------------------------------
*/

 Router::route($url);
