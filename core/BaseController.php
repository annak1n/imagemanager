<?php

/**
 * BaseController is required to be extented in all the controllers of the applicaltion.
 * Initialized, renders and packup functions are required to complete the flow of requrest.
 * 
 * @author Vijay
 */
abstract class BaseController {
    
    /**
     * Request parameters.
     * @var array 
     */
    protected $reqParam = array();
    
    /**
     * Data from the session.
     * @var array 
     */
    protected $sessionData = array();
    
    /**
     * Path of method views and layout to render the output.
     * @var string 
     */
    protected $layout, $view;
    
    
    function __construct() {
        /* Contructor Called */
    }
    
    /**
     * Initialize the controller class, get request params, decide method default view
     * and decide default controller. 
     * @param string $controller
     * @param string $method
     */
    function init($controller, $method) {
        
        $this->reqParam = array_merge($_GET, $_POST);
        $this->decideView($controller, $method);
        $this->decideLayout();
    }
    
    /**
     * Decide the view file according to the controller and method called.
     * @param String $controller
     * @param String $method
     */
    protected function decideView($controller, $method) {
        $this->view = VIEWS_PATH.'/'.$controller.'/'.$method.'.php';
    }
    
    /**
     * Decide the layout to be rendered. Custom layout can be called.
     * @param String $custom_layout
     * @return boolean
     */
    protected function decideLayout($custom_layout = "") {
        if($custom_layout != "" && in_array($custom_layout, ENABLED_LAYOUTS)) {
            $this->layout = VIEWS_PATH.'/'.$custom_layout.'.php';
            return true;
        }
        $this->layout = VIEWS_PATH.'/'.MAIN_LAYOUT.'.php';
            
        return true;
    }

    /**
     * Render the view for a request.
     * @param string $content
     */
    public function render($content = '') {
        $content = $content;
        include_once $this->layout;
    }
    
    /**
     * Shut down every thing after the calls is complete.
     */
    public function packup() {
        /* Release memory */
    }
}
