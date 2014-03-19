<?php
/**
 * Includes all the important and basic files to required to run this application.
 * IMPORTANT!!!
 * Do not change any code in the file without authorization and full understanding of the application structure.
 * Changes in this file may lead crash of application.
 * 
 * @author Vijay Singh <vjpaleo@gmail.com>
 */

/**
 * Include configurarion files.
 * Important!
 */
require_once $_SERVER['DOCUMENT_ROOT'].'/config/config.php';
require_once DOCUMENT_ROOT.'/config/path.php';
require_once DOCUMENT_ROOT.'/config/database.php';
require_once DOCUMENT_ROOT.'/config/session.php';

/**
 * Include Core Classes
 * All the controllers and models extend base Controller and Model classes respectivly.
 */
require_once PathVars::$CORE.'/baseController.php';
require_once PathVars::$CORE.'/baseModel.php';


require_once PathVars::$UTILS.'/commonUtils.php';
