<?php

/**
 * Dashboard controller 
 *
 * @author Vijay Singh <vjpaleo@gmail.com>
 */
class DashboardController extends BaseController {
    
    public function __construct() {
        parent::__construct();
        
        if(!$this->userSess) {
            //CommonUtils::redirect('?c=home&m=index');
        } 
    }
    
    public function index() {
        
    }
    
    public function settings() {
        
    }
    
}