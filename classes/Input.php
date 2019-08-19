<?php
/**
* Input class - handle all requests that sents by GET|POST
* Author - Rshad Bakria
* Email - Rshad541@gmail.com
*/
class Input
{
    /**
     * @param string $type
     * @return bool
     */
    public static function exists($type = 'post')
    {
        switch ($type)
        {
            case 'post':
                return (!empty($_POST)) ? true : false;
                break;
            case 'get':
                return (!empty($_GET)) ? true : false;
                break;
            default:
                return false;
                break;
        }
    }

    /**
     * @param $item
     * @return mixed|string
     */
    public static function get($item)
    {
      if(isset($_POST[$item]))
      {
        return escape($_POST[$item]);
      }elseif(isset($_GET[$item]))
      {
        return escape($_GET[$item]);
      }else{
        return '';
      }
    }
}
