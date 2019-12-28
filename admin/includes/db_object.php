<?php

class Db_object {

    protected static $db_table = "users";

    public static function find_all() {
        return static::find_by_query("SELECT * FROM ". static::$db_table ." ");
    }

    public static function find_by_id($id) {
        global $database;
        $the_result_array = static::find_by_query("SELECT * FROM ". static::$db_table ."  WHERE id = $id LIMIT 1");

        return !empty($the_result_array) ? array_shift($the_result_array) : false;

    }

    public static function find_by_query($sql) {
        global $database;
        $result_set = $database->query($sql);
        $the_object_array = array();                            //creating empty array

        while ($row = mysqli_fetch_array($result_set)) {        //getting result's rows
            $the_object_array[] = static::instantation($row);     //using ins. function to converting type of value => object
        }

        return $the_object_array;                               //returning the object array
    }


    public static function instantation($the_record) {
        
        $calling_class = get_called_class();  //getting class which is called from other inheritance
        
        $the_object = new $calling_class;

        //SHIFT + ALT + DOWN => COPY LINE IN VISUAL STUDIO
        //if we want to write less code, we must be use this loop and reaching each value. Okey?
        //change type of data  KEY => VALUE like JSON. But this is the object.

        foreach ($the_record as $the_attribute => $value) {         
            if($the_object->has_the_attribute($the_attribute)) {    //if we have many of attributes; go straight.
                $the_object->$the_attribute = $value;                //and key-value matching completed...
            }
        }

        return $the_object;
    }

    private function has_the_attribute($the_attribute) {

        $object_properties = get_object_vars($this);    //getting class variables.
        return array_key_exists($the_attribute, $object_properties); 
        /*
            Is the_attribute have an variables which is defined into the class?
            TRUE OR FALSE 
        */

    }

    protected function properties() {
        $properties = array();

        foreach (static::$db_table_fields as $db_f) {
            if(property_exists($this,$db_f)){
                $properties[$db_f] = $this->$db_f;
            }
        }

        //print_r($properties);

        return  $properties;
    }

    protected function clean_properties() {
        global $database;
        $clean_properties = array();

        foreach ($this->properties() as $key => $value) {
            $clean_properties[$key] = $database->escape_string($value);
        }

        return $clean_properties;
    }

    public function save() {

        //if record is already exists, update--.
        //else (record is not exist) insert new.
        return isset($this->id) ? $this->update() : $this->create();
    }


    public function create() {
        global $database;

        $properties = $this->clean_properties();

        $sql  = "INSERT INTO " . static::$db_table ."(" .implode("," , array_keys($properties)). ")";
        $sql .= "VALUES ('" .implode("','" , array_values ($properties)). "')";

        //echo $sql;

        if($database->query($sql)) {
            $this->id = $database->the_insert_id();

            return true;

        } else {

            return false;

        }
    }

    public function update() {
        global $database;
        $properties = $this->clean_properties();
        $properties_pairs = array();

        foreach ($properties as $key => $value) {
            $properties_pairs[] = "{$key}='{$value}'";
        }


        $sql  = "UPDATE ". static::$db_table ." SET ";
        $sql .= implode(", ", $properties_pairs);
        $sql .= " WHERE id= "    .  $database->escape_string($this->id);

        $database->query($sql);

        return (mysqli_affected_rows($database->connection) == 1) ? true : false;
    }

    public function delete() {
        global $database;

        $sql  = "DELETE FROM ". static::$db_table ." ";
        $sql .= "WHERE id= " .$database->escape_string($this->id);
        $sql .= " LIMIT 1";

        $database->query($sql);

        return (mysqli_affected_rows($database->connection) == 1) ? true : false;
    }



}



?>