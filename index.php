<?php 
/*
 | ------------------------------------------------------------
 |                    STARTING SESSION
 | ------------------------------------------------------------
*/
session_start();

/*
 | ------------------------------------------------------------
 |               CONSTANTES DEFINITIONS
 | ------------------------------------------------------------
*/

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__FILE__));


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
 |              REQUIRING CORE FILES
 | ------------------------------------------------------------
*/

 require_once(ROOT. DS . 'core' . DS . 'bootstrap.php');