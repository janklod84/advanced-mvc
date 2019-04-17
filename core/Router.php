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
}