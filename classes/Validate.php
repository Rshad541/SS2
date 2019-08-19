<?php
/**
* Validate Class - make a Validation for your data
* author - Rshad Bakria
* Email - Rshad541@gmail.com
*/
class Validate
{
  /**
  * @var array $_errors
  */
  private $_errors = [];
  /**
  * @var boolean $_passed
  */
  private $_passed = false;
  /**
  * Check Method - make a validation for your data
  * @param string $soruce
  * @param array $items
  * @return $this
  */
  public function check($soruce, $items)
  {
    foreach($items as $item => $rules)
    {
        foreach($rules as $rule => $rule_value)
        {
          $display = (isset($items[$item]['display']))?$items[$item]['display']:$item;
          $value = $soruce[$item];

          if(empty($value) && $rule = 'required')
          {
            $this->addError("{$display} Field Is Requierd");
          }else{
            switch($rule)
            {
              case 'min':
              if(strlen($value) < $rule_value)
              {
                $this->addError("{$display} Must Be More Than {$rule_value} Characters.");
              }
              break;
              case 'max':
              if(strlen($value) > $rule_value)
              {
                $this->addError("{$display} Must Be Less Than {$rule_value} Characters.");
              }
              break;
              case 'match':
              if($value != $soruce[$rule_value])
              {
                $this->addError("{$display} Must Match {$rule_value}");
              }
              break;
              case 'unique':
                $check = DB::getInstance()->query("SELECT {$item} FROM {$rule_value} WHERE {$item} =?",[$value])->count();
                if($check)
                {
                  $this->addError("{$display} Already Exists");
                }
              break;
              case 'type':
                    switch($rule_value)
                    {
                      case 'string':
                        if(!filter_var($value,FILTER_SANITIZE_STRING))
                        {
                          $this->addError("{$display} Must Be A Valid String");
                        }
                      break;
                      case 'int':
                        if(!filter_var($value,FILTER_SANITIZE_NUMBER_INT))
                        {
                          $this->addError("{$display} Must Be An Integer");
                        }
                      break;
                      case 'email':
                        if(!filter_var($value,FILTER_VALIDATE_EMAIL))
                        {
                          $this->addError("Invalid Email");
                        }
                      break;
                    }
              break;
            }
          }
        }
    }
    if(empty($this->_errors))
    {
      $this->_passed = true;
    }
    return $this;
  }
  /**
  * Passed Method - check if the Validation passed
  * @return boolean
  */
  public function passed()
  {
    return $this->_passed;
  }
  /**
  * AddError Method - insert a new error message into errors array
  */
  private function addError($error)
  {
    $this->_errors[] = $error;
  }
  /**
  * @return array
  */
  public function errors()
  {
    return $this->_errors;
  }
}
