<?php
/**
 * Class Session
 * author - Rshad Bakria
 * Email - Rshad541@gmail.com
 */
class Session
{
    /**
     * @param string $name
     * @return bool
     */
  public static function exists($name)
  {
    return (isset($_SESSION[$name])) ? true : false;
  }

    /**
     * @param string $name
     * @param string $value
     * @return string mixed
     */
  public static function set($name, $value)
  {
    return $_SESSION[$name] = $value;
  }

    /**
     * @param string $name
     * @return mixed
     */
  public static function get($name)
  {
    if(self::exists($name))
    {
      return $_SESSION[$name];
    }
  }

    /**
     * @param string $name
     * @return bool
     */
  public static function delete($name)
  {
    if(self::exists($name))
    {
      unset($_SESSION[$name]);
      return true;
    }
    return false;
  }

    /**
     * @param string $name
     * @param null $value
     * @return mixed
     */
  public static function flash($name, $value = null)
  {
    if(self::exist($name))
    {
      $session = self::get($name);
      self::delete($name);
      return $session;
    }else{
      self::set($name, $value);
    }
  }
}
