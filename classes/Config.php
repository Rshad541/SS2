<?php

/**
 * Class Config
 * author - Rshad Bakria
 * Email - Rshad541@gmail.com
 */
class Config
{
    /**
     * @param $path
     * @return mixed
     */
  public static function get($path)
  {
    if($path)
    {
        $config = $GLOBALS['config'];

        $path = explode('/', $path);

        foreach ($path as $bit) {

            if (isset($config[$bit])) {

                $config = $config[$bit];
            }
        }

        return $config;
    }
  }
}
