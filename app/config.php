<?php
ini_set("display_errors", 1); // * display all errors
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);

define('APP_KEY', 'iamnotthesecretkey'); // * needed by authenticate.php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'my_database');
