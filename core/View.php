<?php
class View
{
    public static function start($type)
    {
        switch ($type) {
            case 'head':
                include LAYOUTS . 'header_start.php';
                break;
            
            case 'body':
                include LAYOUTS . 'body_start.php';
                break;
            
            default:
                return false; 
                break;
        }
    }
    public static function end($type)
    {
        switch ($type) {
            case 'head':
                include LAYOUTS . 'header_end.php';
                break;
            
            case 'body':
                include LAYOUTS . 'body_end.php';
                break;
            
            default:
                return false; 
                break;
        }
    }

    public static function nav()
    {
        include LAYOUTS . 'nav.php';
    }
}