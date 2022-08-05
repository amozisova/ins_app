<?php


/**
 * Front controller
 */

/**
 * Composer - autoloader
 */
require_once '../vendor/autoload.php';

/**
 * Error and Exception Handling
 */
error_reporting(E_ALL);
set_error_handler('Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');

/**
 * Sessions
 */
session_start();


/**
 * Routing
 */
require_once '../Core/Router.php';

$router = new Core\Router();

// Add the routes
$router->add('', ['controller' => 'Home', 'action' => 'index']);
$router->add('logout', ['controller' => 'Login', 'action' => 'destroy']);
$router->add('{controller}/{action}');
//$router->add('{controller}/{id:\d+}/{action}');
//$router->add('admin/{controller}/{action}',['namespace'=>'Admin']);
    
$router->dispatch($_SERVER['QUERY_STRING']);