<?php

class Session {

    private $signed_in = false; //default value is user not logged in.
    public  $user_id;           //what is the user_id who logged in?
    public  $message;

    function __construct() {
        session_start();
        //initialize => must be load with this method! (required)
        $this->check_the_login();
        $this->check_message();
    }

    public function message($msg="") {
        if(!empty($msg)) {
            $_SESSION["message"] = $msg;
        }else {
            return $this->message;
        }
    }

    private function check_message() {
        if(isset($_SESSION["message"])) {
            $this->message = $_SESSION["message"];
            unset($_SESSION["message"]);
        }else {
            $this->message = "";
        }
    }

    public function is_signed_in() {
        //returning value : : is user signed-in or not?
        return $this->signed_in;
    }

    public function login($user) {
        if($user){
            //multiple_assignment right to left  <------------
            $this->user_id = $_SESSION["user_id"] = $user->id;
            $this->signed_in = true;
        }
    }

    public function logout() {
        //we must be remove user_id and session
        unset($_SESSION["user_id"]);
        unset($this->user_id);
        $this->signed_in = false;
    }

    //this method only accessed by into the classs
    private function check_the_login() {
        if(isset($_SESSION["user_id"])) {
            $this->user_id = $_SESSION["user_id"];
            $this->signed_in = true;
            /*
            if user logged_in, $user_id variable which is 
            into the this method value must be equals user_id and
            signed in variable (into the class) = true; 
            */
        }else {
            unset($this->user_id);
            $this->signed_in = false;
        }
    }

}


$session = new Session();   //we'll use this object in the future.


?>