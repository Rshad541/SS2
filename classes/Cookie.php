<?php
/**
 * Cookie Class -
 * author - Rshad
 * Email - Rshad541@gmail.com
 */
 class Cookie
 {
   /**
    *  @param string $name
    *  @return boolean
    */
   public static function exists($name)
   {
     return (isset($_COOKIE[$name])) ? true : false;
   }
   /**
    * @param string $name
    * @return mixed|null
    */
   public static function get($name)
   {
     if(self::exists($name))
     {
       return $_COOKIE[$name];
     }
   }
   /**
    * @param string $name
    * @param mixed $value
    * @return boolean
    */
   public static function set($name,$value)
   {
     if(setcookie($name, $value, time() + Config::get('cookie/cookieExpire'), '/'))
     {
       return true;
     }
     return false;
   }
   /**
    * @param string $name
    * @return boolean
    */
   public static function delete($name)
   {
     if(self::exists($name))
     {
       self::set($name, '', time()-1);
       return true;
     }
     return false;
   }

 }
