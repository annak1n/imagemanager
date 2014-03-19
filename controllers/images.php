<?php

/**
 * Images controller. 
 *
 * @author Vijay Singh <vjpaleo@gmail.com>
 */
/* Inclue images model. */
include_once PathVars::$MODELS . '/images.php';

class ImagesController extends BaseController {

    private $objImageModel;

    public function __construct() {
        parent::__construct();

        /* Initilize image model */
        $this->objImageModel = new Images();
    }

    /**
     * Display the image upload form.
     * Upload and save the images physically and in the database.
     */
    public function upload() {


        /* Image upload form submitted. */
        if (isset($this->reqPost['imageUpload'])) {

            /* Check required fields for user login. */
            if (!isset($_FILES['imageFile']) || $_FILES["imageFile"]["error"] > 0) {

                /* There is some error in uploading the file. */
                $this->viewData['iu_form_error'] = "Please select an image file to upload.";
            } elseif ($_FILES["imageFile"]["size"] > Config::$IMAGE_MAX_SIZE) {

                /* check allowed image size. */
                $this->viewData['iu_form_error'] = "Maximum image size that can be uploaded is " . (Config::$IMAGE_MAX_SIZE / 1024) . "kb. ";
            } elseif (!in_array($_FILES["imageFile"]["type"], Config::$IMAGE_ALLOWED_TYPES)) {

                /* check apploed image types. */
                $this->viewData['iu_form_error'] = "Allowed types of images that can be uploaded are " . implode(', ', Config::$IMAGE_ALLOWED_TYPES) . ". ";
            } else {

                /* Save the image in the database. */
                $inData = array();
                $inData['i_u_id'] = $this->userSess['u_id'];
                $inData['i_name'] = $_FILES["imageFile"]["name"];
                $inData['i_title'] = $this->reqPost["imageTitle"];
                $inData['i_datetime'] = CommonUtils::nowDataTime();
                $response = $this->objImageModel->insertImage($inData);
                if ($response['status']) {
                    /* if image details are saved successfully then save image file and rename it to ID + _ + IMAGE NAME. */
                    if (move_uploaded_file($_FILES["imageFile"]["tmp_name"], PathVars::$IMAGE_UPLOAD . "/" . $response['i_id'] . '_' . $_FILES["imageFile"]["name"])) {
                        echo "Stored in: " . "upload/" . $_FILES["file"]["name"];

                        CommonUtils::redirect('?c=images&m=listAll&msg=success');
                    }
                }
            }
        }
        
    }

    public function listAll() {
        /* List of the images. */

        /**
         * Check if loggedin user is an admin or standard user.
         * if Admin show images of all the users.
         * else show images of logged in user.
         */
        $this->viewData['images_list'] = array();

        $inData = array();
        $inData['limit'] = 100;
        
        if (!$this->userSess['u_is_admin']) {
            /* if user is not admin then user can only see his own images. */
            $inData['where']['i_u_id'] = $this->userSess['u_id'];
        }
        $inData['orderby'] = ' i_datetime DESC '; // get latest photos by default

        $this->viewData['images_list'] = $this->objImageModel->getImages($inData);

        if (isset($this->reqGet['msg']) && $this->reqGet['msg'] == 'delsuccess') {
            $this->viewData['iu_form_error'] = " Delete successful! ";
        } elseif (isset($this->reqGet['msg']) && $this->reqGet['msg'] == 'success') {
            $this->viewData['iu_form_error'] = " Upload successful! ";
        }
    }

    public function detail() {
        /* Show image details. */
    }

    public function edit() {
        /* Load image edit details form. */
    }

    public function save() {
        /* Save image details. */
    }

    /**
     * Delete the image.
     */
    public function delete() {
        /**
         * Delete images. 
         * First select all the images to delete them physically.
         * Second delete should images from database.
         * Third delete the physical image files.
         */
        $inData = array();
        $inData['where']['i_id'] = $this->reqGet['id'];
        $inData['where']['i_name'] = $this->reqGet["name"];
        
        if( $this->objImageModel->deleteImages($inData)) {
            @unlink(PathVars::$IMAGE_UPLOAD . "/" . $this->reqGet['id'] . '_' . $this->reqGet['id']);
            CommonUtils::redirect('?c=images&m=listAll&msg=delsuccess');
        }
        
        CommonUtils::redirect('?c=images&m=listAll');
    }

}