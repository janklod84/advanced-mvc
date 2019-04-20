<?php 


class EmailValidator  extends CustomValidator
{
       
       /**
        * Run Validation
        * @return bool
       */
       public function runValidation()
       {
           $email = $this->model->{$this->field};
           $pass  = true;
           if(!empty($email))
           {
           	   $pass = filter_var($email, FILTER_VALIDATE_EMAIL);
           }
           return $pass;
       }
}