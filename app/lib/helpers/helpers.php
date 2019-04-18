<?php 

/*
 | ------------------------------------------------------------
 |         HELPERS REGISTER
 | ------------------------------------------------------------
*/

function dnd($data)
{
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
    die();
}


function debug($data, $die = false)
{
	 echo '<pre>';
     print_r($data);
     echo '</pre>';
     if($die) die;
}


function sanitize($dirty)
{
	return htmlentities($dirty, ENT_QUOTES, 'UTF-8');
}