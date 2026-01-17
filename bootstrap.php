<?php
    // fa fare log degli errori 
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    session_start();
    //define("UPLOAD_DIR", "./upload/");
    //require_once("utils/functions.php");
    require_once("db/database.php");
    $dbh = new DatabaseHelper("localhost", "root", "", "spotted", 3306);
?>