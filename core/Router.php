<?php 



class Router 
{

        /**
         * Run routing
         * $controller can named like $part or $path
         * 
         * @param string $url Ex: $url = http://mvc.loc/users/register/567/new
         * @return mixed
         */
        public static function route($url)
        {

        	 // controller
             $controller = (isset($url[0]) && $url[0] != '') ? ucwords($url[0]) : DEFAULT_CONTROLLER;
             $controller_name = $controller; // Users
             array_shift($url);

             // action 
             $action = (isset($url[0]) && $url[0] != '') ? $url[0] . 'Action' : 'indexAction';
             $action_name = $controller; // registerAction
             array_shift($url);


             // acl check
             $grantAccess = self::hasAccess($controller_name, $action_name);
             
             # if we don't have permission access
             if(!$grantAccess) 
             {
                 # we'll change controller name to:
                 $controller_name = $controller = ACCESS_RESTRICTED;
                 $action = 'indexAction';
             }



             // params
             $queryParams = $url; // ['0' => '567', '1' => 'new']


             // dispatching [$dispatch = new Users($controller_name, $action)]
             $dispatch = new $controller($controller_name, $action);
             
             // check if method $action exist in class $controller
             if(method_exists($controller, $action))
             {
             	   // $dispatch->{$action}($queryParams)
                   call_user_func_array([$dispatch, $action], $queryParams);

             }else{

             	 die('That method does not exist in the controller \"'. $controller_name . '\"');
             }
        }   

        
        /**
         * Redirect to given param
         * @param string $location 
         * @return void
         */
        public static function redirect($location = '')
        {
            if(!headers_sent())
            {
                 header('Location: '. PROOT . $location);
                 exit();

            }else{
 
                 echo '<script type="text/javascript">';
                 echo 'window.location.href="'. PROOT . $location .'";';
                 echo '</script>';
                 echo '<noscript>';
                 echo '<meta http-equiv="refresh" content="0;url='. $location . '" />';
                 echo '</noscript>';
                 exit();
            }
        }

        
        /**
         * Determine if have access
         * @return bool
        */
        public static function hasAccess($controller_name, $action_name = 'index')
        {
                $acl_file = file_get_contents(ROOT . DS . 'app' . DS . 'acl.json');
                $acl = json_decode($acl_file, true);
                $current_user_acls = ["Guest"];
                $grantAccess = false;

                if(Session::exists(CURRENT_USER_SESSION_NAME))
                {
                     $current_user_acls[] = "LoggedIn";

                     foreach(currentUser()->acls() as $a)
                     {
                          $current_user_acls[] = $a;
                     }
                }

                debug($current_user_acls, true);

        }




}