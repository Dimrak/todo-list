<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

include 'includes/functions.php';

require __DIR__ . "/vendor/autoload.php";

/**
 * Helper will find the controller on the route system below
 *
 * Controller will be extended by each controller to reach the
 *
 * View class, which would load up the template required +
 * header and footer
 */
use App\Helper\Helper;
use App\Controller\ErrorController;
use App\Controller\TodoController;

//To get the path from the browser
if (isset($_SERVER['PATH_INFO'])) {
    $path = $_SERVER['PATH_INFO'];
} else {
    $path = '/';
}

//separating each word
$path = explode('/', $path);
$helper = new Helper();

//setting up routing system
if (isset($path[1]) && !empty($path[1])){
    $controller = $helper->getController($path[1]);
    if (isset($path[2]) && !empty($path[2])){
        $method = $path[2];
    }else{
        $method = 'index';
    }
    if (class_exists($controller)) {
        $object = new $controller;
        if (method_exists($object, $method)) {
            if (isset($path[3]) && !empty($path[3])) {
                $id = $path[3];
                $object->{$method}($id);
            } else {
                $object->{$method}();
            }
        } else {
            $error = new ErrorController();
            $error->errorMethod();
        }
    }else{
        $error = new ErrorController();
        $error->errorPage();
    }

}else {
    $home = new TodoController();
    $home->index();
}

