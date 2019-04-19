<?php 


class MinValidator  extends CustomValidator
{
       
       /**
        * Run Validation
        * @return bool
       */
       public function runValidation()
       {
           $value = $this->model->{$this->field};
           $pass  = (strlen($value) >= $this->rule);
           return $pass;
       }
}