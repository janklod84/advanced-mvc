<?php 


class Input 
{

       /**
        * Sanitize requests data
        * @param string $input 
        * @return string
       */
	   public static function get($input)
	   {
	   	    if(isset($_POST[$input]))
	   	    {
               return FH::sanitize($_POST[$input]);

	   	    }elseif(isset($_GET[$input])){

	   	    	return FH::sanitize($_GET[$input]);
	   	    }
	   }
}