<?php 

/*
 | ------------------------------------------------------------
 |         HELPERS REGISTER
 | ------------------------------------------------------------
*/


/**
 * Functions for pretty print array data
 * @param array $data
 * @param bool $die
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


/**
 * Sanitize data
 * @param mixed $dirty
*/
function sanitize($dirty)
{
	return htmlentities($dirty, ENT_QUOTES, "UTF-8");
}


/**
 * Return current logged user 
*/ 
function currentUser()
{
	return Users::currentLoggedInUser();
}


/**
 * Sanitize posted data and return them
 * And conserve values
 * 
 * @param array $post from request $_POST
 * @return array
*/ 
function posted_values($post)
{
    $clean_array = [];

    foreach($post as $key => $value)
    {
        $clean_array[$key] = sanitize($value);
    }

    return $clean_array;
}


/**
 * Return current page
 * @return string
*/
function currentPage()
{
    $currentPage = $_SERVER['REQUEST_URI'];

    if($currentPage == PROOT || $currentPage == PROOT . 'home/index')
    {
         $currentPage = PROOT . 'home';
    }

    return $currentPage;
}


/**
 * Get object properties
 * @param object $obj 
 * @return mixed
*/
function getObjectProperties($obj)
{
    return get_object_vars($obj);
}