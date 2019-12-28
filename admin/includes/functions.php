<?php

function classAutoLoader($class) {

    /*
        Always we use class name with the same file name.
        So, this functions.php file automatically load 
        file which is name equals to class name.
        For example if we want to use class which is not exists;
        this php file getting error with path/file name...
    */

    $class = strtolower($class);
    $the_path = "includes/{$class}.php";
    
    if (is_file($the_path) && !class_exists($class)){
        include $the_path;
    }
}

spl_autoload_register('classAutoLoader');

function redirect($location) {
    header("Location:{$location}");
}

?>