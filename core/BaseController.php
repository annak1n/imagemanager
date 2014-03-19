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
    protected $reqGet = array();
    protected $reqPost = array();
    
    /**
     * Data from the session.
     * @var array 
     */
    protected $sessionData = array();
    
    /**
     * Controller View
     * @var string 
     */
    protected $content;
    
    /**
     * Name of the controller called.
     * @var string 
     */
    protected $controller;
    
    /**
     * Name of the method called.
     * @var string  
     */
    protected $method;
    
    /**
     * Path of method views and layout to render the output.
     * @var string 
     */
    protected $layout, $view;
    
    /**
     * Variable data passed from controller to view.
     * @var array
     */
    protected $viewData = array();
    
    /**
     * User session data when user is logged in.
     * @var array 
     */
    protected $userSess = array();
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
        
        $this->controller = $controller;
        $this->method = $method;
        
        $this->reqParam = array_merge($_GET, $_POST);
        
        $this->reqPost = $_POST;
        
        $this->reqGet = $_GET;
        
        $this->userSess = Session::getUserData();
        
        if($this->userSess) {
            
            $this->viewData['usEmail'] = $this->userSess['u_email'];
            $this->viewData['usId'] = $this->userSess['u_id'];
            $this->viewData['usIsAdmin'] = $this->userSess['u_is_admin'];

        }
            
        $this->decideView($controller, $method);
        $this->decideLayout();
    }
    
    /**
     * Decide the view file according to the controller and method called.
     * @param String $controller
     * @param String $method
     */
    protected function decideView($controller, $method) {
        $this->view = PathVars::$VIEWS.'/'.$controller.'/'.$method.'.php';
    }
    
    /**
     * 
     * @param string $custom_view - custom view page.
     * @return string
     */
    protected function generateView($custom_view = "", $force_custom = false) {
        
        /* Start buffer.*/
        ob_start();
        ob_clean();
        
        $viewFilePath = PathVars::$VIEWS.'/'.$custom_view.'.php';
        
        /* Convert all the data set in controller methods to variable. */
        extract($this->viewData);
        
        if(is_file($viewFilePath)) {
            
            /* Create custom view path. */
            include_once $viewFilePath;
        } elseif(!is_file($viewFilePath) && $force_custom){
            /**
             * Forcing to load custom view only, to avoid loading of same page inside itself
             * in case custom view file is not found.
             * Custom view not found. -- Log error.
             */
        } else {
            
            /* Create default view path.*/
            $this->decideView($this->controller, $this->method);
            
            include_once $this->view;
        }
        /* set the controller view content to $content variable. */
        $content = ob_get_contents();
        /* clean buffer */
        ob_end_clean();
        
        
        return $content;
    }
    
    protected function loadCustomView($custom_view) {
        
        echo $this->generateView($custom_view, true);
        
    }
    
    /**
     * Decide the layout to be rendered. Custom layout can be called.
     * @param String $custom_layout
     * @return boolean
     */
    protected function decideLayout($custom_layout = "") {
        
        if($custom_layout != "" && in_array($custom_layout, Config::$ENABLED_LAYOUTS)) {
            $this->layout = PathVars::$VIEWS.'/layouts/'.$custom_layout.'.php';
            return true;
        }
        $this->layout = PathVars::$VIEWS.'/layouts/'.  Config::$MAIN_LAYOUT.'.php';
            
        return true;
    }

    /**
     * Render the view for a request.
     * @param string $content
     */
    public function render($custom_view = "") {
        
        $content = $this->generateView($custom_view);
        try {
            if(!is_file($this->layout)) {
                
                throw new Exception("Invalid layout");
            }
            
            include_once $this->layout;
            
        } catch (Exception $ex) {
            
        }
        
    }
    
    /**
     * Shut down every thing after the calls is complete.
     */
    public function packup() {
        /* Release memory */
    }
}
