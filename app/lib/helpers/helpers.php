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


function pre($data, $die = false)
{
	 echo '<pre>';
     print_r($data);
     echo '</pre>';
     if($die) die;
}


function debug($data, $die = false)
{
	 pre($data, $die);
}