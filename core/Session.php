<?php 


class Session 
{
        
        /**
         * Determine if key exist in session
         * @param string $name 
         * @return bool
        */
        public static function exists($name)
        {
        	 return (isset($_SESSION[$name])) ? true : false;
        }	


        
        /**
         * Return session value
         * @param type $name 
         * @return mixed
        */
        public static function get($name)
        {
        	 return $_SESSION[$name];
        }

        
        /**
         * Set item
         * @param string $name 
         * @param mixed $value 
         * @return void
        */
        public static function set($name, $value)
        {
             return $_SESSION[$name] = $value;
        }

        
        /**
         * Delete item from $_SESSION
         * @param string $name 
         * @return void
        */
        public static function delete($name)
        {
              if(self::exists($name))
              {
              	  unset($_SESSION[$name]);
              }
        }

        
        /**
         * Store version number
         * @return 
        */
        public static function uagent_no_version()
        {
            $uagent = $_SERVER['HTTP_USER_AGENT'];
            $regex = '/\/[a-zA-Z0-9.]+/';
            $newString = preg_replace($regex, '', $uagent);
            return $newString;
        }
}