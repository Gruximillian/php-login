<?php

  // If __CONFIG__ is not defined, then do not load this file
  if (!defined("__CONFIG__")) {
    // Most likely, we would want to do a redirect here instead of exiting
    exit("No config file!");
  }

  //  Sessions are always turned on
  if (!isset($_SESSION)) {
    session_start();
  }

  // Config code is bellow

  // Allow errors
  error_reporting(-1);
  ini_set("display_errors", "On");


  // Include the DB.php file
  include_once "classes/DB.php";
  include_once "classes/Filter.php";
  include_once "functions.php";

  $con = DB::getConnection();

?>
