<?php 

require_once("conn.php");

class Database{

    public $connection;

    //load open_db_connection() function automatically
    function __construct(){
        $this->open_db_connection();
    }

    public function open_db_connection(){

        //creating mysqli object for connection.
        $this->connection = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);


        if(mysqli_connect_errno()){

            die("Database Connection Failed!".mysqli_error());

        }

    }

    public function query($sql){

        //this function used for implementing query
        $result = $this->connection->query($sql);
        $this->confirm_query($result);

        return $result;

    }

    //this function used for: query has an error or not?
    private function confirm_query($result){
        if(!$result){
            die("Query Failed!". $this->connection->error);
        }

    }

    //security:real escape string
    public function escape_string($string){
        $escaped = $this->connection->real_escape_string($string);
        return $escaped;
    }


    public function the_insert_id(){
        return mysqli_insert_id($this->connection);
    }


}





$database = new Database ();




?>