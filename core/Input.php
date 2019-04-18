<?php 


class Input 
{

       
       /**
        * Sanitize data
        * @param string $dirty 
        * @return string
       */
	   public static function sanitize($dirty)
	   {
	     	return htmlentities($dirty, ENT_QUOTES, "UTF-8");
	   }

       
       /**
        * Sanitize requests data
        * @param string $input 
        * @return string
       */
	   public static function get($input)
	   {
	   	    if(isset($_POST[$input]))
	   	    {
               return self::sanitize($_POST[$input]);

	   	    }elseif(isset($_GET[$input])){

	   	    	return self::sanitize($_GET[$input]);
	   	    }
	   }
}