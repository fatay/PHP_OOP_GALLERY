<?php 

defined('DS') ? null : define('DS',DIRECTORY_SEPARATOR); //terniary usage
defined('SITE_ROOT') ? null : define('SITE_ROOT', DS . 'xampp' . DS . 'htdocs' . DS . 'oop-gallery');
defined('INCLUDES_PATH') ? null : define('INCLUDES_PATH', SITE_ROOT .DS. 'admin' .DS. 'includes');
//And after this defining, SITE ROOT automatically assigned by this code... 



//shift + alt + down key => duplicate line in vs code
require_once("functions.php");
require_once("conn.php");
require_once("database.php");
require_once("db_object.php");
require_once("user.php");
require_once("photo.php");
require_once("session.php");






?>