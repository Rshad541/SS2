<?php
/**
 *  Autoloading Class
 *  author - Rshad
 *  Email - Rshad541@gmail.com
 */
class Autoload
{

  public static function load($class)
  {
      $class = ucfirst($class) . '.php';
      $class = CLASSES . $class;
      if(file_exists($class))
      {
        require_once $class;
      }
  }
}

spl_autoload_register('Autoload::load');
