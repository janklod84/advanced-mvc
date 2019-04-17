<?php 
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


function setPath($path)
{
   return ROOT . DS . $path . '.php';
}


function autoload($className)
{
	    if(file_exists(ROOT . DS . 'core' . DS . $className . '.php'))
	    {
	    	require_once(ROOT . DS . 'core' . DS . $className . '.php');

	    }elseif(file_exists(ROOT . DS . 'app' . DS . 'controllers' . DS . $className . '.php')){

	        require_once(ROOT . DS . 'app' . DS . 'controllers' . DS . $className . '.php');

	    }elseif(file_exists(ROOT . DS . 'app' . DS . 'models' . DS . $className . '.php')){

	        require_once(ROOT . DS . 'app' . DS . 'models' . DS . $className . '.php');
	    }
}

spl_autoload_register('autoload');


/*
 | ------------------------------------------------------------
 |          START ROUTING [ ROUTE THE REQUEST ]
 |          $url from index.php [it's global variable] $_SERVER['PATH_INFO']
 | ------------------------------------------------------------
*/

 Router::route($url);