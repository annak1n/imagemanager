<?php

/**
 * Images controller. 
 *
 * @author Vijay Singh <vjpaleo@gmail.com>
 */
class ImagesController extends BaseController {
    
    public function __construct() {
        parent::__construct();
        /* Initilize image model */
    }
    
    public function upload() {
        /* Check image max size allowed. */
        
    }
    
    public function listAll($isAdmin = false) {
        /* List of the images.*/
        
        /**
         * Check if loggedin user is an admin or standard user.
         * if Admin show images of all the users.
         * else show images of logged in user.
         */
        $this->viewData['images_list'] = array();
    }
    
    public function detail() {
        /* Show image details.*/
    }
    
    public function edit() {
        /* Load image edit details form. */
    }
    
    public function save() {
        /* Save image details. */
    }
    
    public function assign() {
        /* assign an image to a user. */
        
    }
    
}