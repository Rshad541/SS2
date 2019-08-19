<?php
ob_start();
session_start();

// Application Paths
defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);

defined('ROOT') ? null : define('ROOT',realpath(dirname(__FILE__). DS . '..'));

defined('CONFIG') ? null : define('CONFIG', ROOT . DS . 'config' . DS);

defined('FUNCTIONS') ? null : define('FUNCTIONS', ROOT . DS . 'functions' . DS);

defined('CLASSES')  ? null : define('CLASSES', ROOT . DS . 'classes' . DS);

defined('CORE')  ? null : define('CORE', ROOT . DS . 'core' . DS);

defined('LAYOUTS') ? null : define('LAYOUTS', ROOT . DS . 'layouts' . DS);

defined('VENDOR') ? null : define('VENDOR', ROOT . DS . 'vendor' . DS);

defined('ASSETS') ? null : define('ASSETS' , '/assets/');
 
// Configuration file
require_once CONFIG . 'app.php';

// Autoloading class
require_once CORE . 'Autoload.php';

// View Class
require_once CORE . 'View.php';

// Helpers Functions
require_once FUNCTIONS . 'helpers.php';

// Vendor Autoloader
require_once VENDOR . 'autoload.php';

// whoops error page handler
$whoops = new \Whoops\Run;
$whoops->prependHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

