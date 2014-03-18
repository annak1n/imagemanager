<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once 'config/include.php';

try {

    /**
     * Read the URL and decide the controller and method being to be called.
     * Use reflection class to instatiate the contoller.
     */
    /**
     * Complete request URL
     */
    echo $url = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
    
    /**
     * Default controller.
     */
    $controller = DEFAULT_CONTROLLER; // config.php

    /**
     * Default method.
     */
    $method = DEFAULT_METHOD; // config.php

    /**
     * Read controller from url.
     */
    $controller = CommonUtils::findController($url);

    /**
     * Read method/ action from url
     */
    $method = CommonUtils::findMethod($url);

    /**
     * Create of path to controller file.
     */
    $controllerFile = CommonUtils::getControllerFile();

    /* Check if controller requested in the url exists. */
    if (!is_file($controllerFile)) {

        /* Controller file doesn't exists. */
        throw new Exception("Invalid Controller", 404);
    }

    include_once $controllerFile;
    
    /**
     * Create controller class name.
     */
    $controllerClass = ucfirst($controller).'Controller';
    
    /**
     * check controller class exists
     */
    if (!class_exists($controllerClass)) {

        /* controller class doesn't exist */
        throw Exception("Invalid Controller", 404);
    }
    
    $objController = ReflectionClass($controllerClass);
    
    $objMethod = $objController->getMethod('init');
    $objMethod->invoke();

    if ($objController->hasMethod($method)) {
        $objMethod = $objController->getMethod($method);
        $objMethod->invoke();
    } else {
        throw Exception("Invalid Method", "404");
    }
    
    $objMethod = $objController->getMethod('render');
    $objMethod->invoke();
    
    $objMethod = $objController->getMethod('packup');
    $objMethod->invoke();
    
} catch (Exception $ex) {
    /*@TODO log this and show 404 error page instead. */
    echo '<br/>Exception: ' . $ex->getCode() . ' - ' . $ex->getMessage() . ' at line ' . $ex->getLine() . ' in file ' . $ex->getFile();
}
exit();
