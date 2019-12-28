<?php

class Photo extends Db_object {

    //A couple of settings here
    protected static $db_table = "photos";
    protected static $db_table_fields = array('id','title','description','filename','type','size');    
    public $id;
    public $title;
    public $description;
    public $filename;
    public $type;
    public $size;
    public $tmp_path;
    public $upload_dir = "images";
    public $errors = array();

    /* PHP ERROR LIST when we want to upload new file */
    public $upload_errors_array = array(
        UPLOAD_ERR_OK           => "There is no error!",
        UPLOAD_ERR_INI_SIZE     => "The uploaded file exceeds max file size!",
        UPLOAD_ERR_FORM_SIZE    => "The uploaded file exceeds MAX_FILE_SIZE directive.",
        UPLOAD_ERR_PARTIAL      => "The uploaded file was only partially uploaded.",
        UPLOAD_ERR_NO_FILE      => "No file was uploaded",
        UPLOAD_ERR_NO_TMP_DIR   => "Missing a temporary folder.",
        UPLOAD_ERR_CANT_WRITE   => "Failed to write file to disk.",
        UPLOAD_ERR_EXTENSION    => "A php extension stops the file upload."
    );

    public function set_file($file) {
        //if no problem was occured -> upload image file
        //file is not => empty, null or !array!
        if(empty($file) || !$file || !is_array($file)) {
            $this->errors[] = "There was no uploaded here.";
            return false;
        } elseif($file['error'] != 0) {
            //if error was occured
            $this->errors[] = $this->upload_errors_array[$file['error']];
        } else {

            $this->filename = basename($file['name']);
            $this->tmp_path = $file['tmp_name'];
            $this->type = $file['type'];
            $this->size = $file['size'];

        }

    }


    public function picture_path(){
        return $this->upload_dir.DS.$this->filename;
    }

    public function delete_photo() {
        if($this->delete()) {       //first, delete from database
            $target_path =  SITE_ROOT.DS.'admin'.DS.$this->picture_path();
            return unlink($target_path) ? true : false;
        } else {
            echo "Error when deleting photo!";
        }

    }

    public function save() {

        //if image_id via img already exists, only upload this one.
        //else create a new image. This would be useful way.

        if($this->id) {
            $this->update();
        } else {
         
            if(!empty($this->errors)) {
                return false;
            }

            if(empty($this->filename) || empty($this->tmp_path)) {
                $this->errors[] = "the file was not avilable.";
                return false;
            }

            $target_path = SITE_ROOT . DS . 'admin' . DS . $this->upload_dir . DS . $this->filename;

            if(file_exists($target_path)) {
                $this->errors[] = "This file already exists";
                return false;
            }

            //try to send all image datas from temporary to target!
            if(move_uploaded_file($this->tmp_path,$target_path)) {
                if($this->create()) {       //if create was success
                    unset($this->tmp_path); //delete & unset temporary
                    return true;
                }
            } else {
                //we have a permission error :(
                $this->errors[] = "the file directory probably doesn't have permission. ";
                return false;
            }   

        }

    }


}



?>