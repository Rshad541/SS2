<?php
/**
 * Token Class -
 * author - Rshad
 * Email - Rshad541@gmail.com
 */
class Token
{
  public static function generate()
  { 
   return Session::set(Config::get('session/tokenName'), Hash::unique());
  }
  /**
   * @param mixed $token
   * @param string $type
   * @return boolean
   */
  public static function check($token,$type = 'user')
  {
      
      $tokenName = Config::get('session/tokenName');

    if(Session::exists($tokenName) && $token == Session::get($tokenName))
    {
      Session::delete($tokenName);
      return true;
    }
    return false;
  }
}
