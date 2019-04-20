<?php 


class NumericValidator  extends CustomValidator
{
       
       /**
        * Run Validation
        * @return bool
       */
       public function runValidation()
       {
           $value = $this->model->{$this->field};
           $pass = true;
           if(!empty($value))
           {
              $pass = is_numeric($value);
           }
           return $pass;
       }
}