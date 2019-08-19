<?php
// helpers functions

/**
 * Pre function
 */
 function pre($string)
 {
   echo '<pre>';
   var_dump($string);
   echo '</pre>';
   die("PRE FUNCTION");
 }

/**
 * Escape function
 */
 function escape($string)
 {
   return htmlentities($string, ENT_QUOTES, 'UTF-8');
 }

/**
 * Title Function
 */
function title()
{
    global $title;
    if(isset($title))
    {
        return $title;
    }else{
        return 'SMS-2';
    }
}