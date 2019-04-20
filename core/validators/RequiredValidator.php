<?php 


class RequiredValidator  extends CustomValidator
{
       
       /**
        * Run Validation
        * @return bool
       */
       public function runValidation()
       {
           $value = $this->model->{$this->field};
           $passes  = (!empty($value));
           return $passes;
       }
}