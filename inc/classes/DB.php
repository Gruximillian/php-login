<?php

  // If __CONFIG__ is not defined, then do not load this file
  if (!defined("__CONFIG__")) {
    // Most likely, we would want to do a redirect here instead of exiting
    exit("No config file!");
  }

  class DB {

    protected static $con;

    private function __construct() {
      try {
        self::$con = new PDO("mysql:charset=utf8mb4;host=localhost;port=3306;dbname=php_login", "gruja", "SuperLamePassword");
        self::$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        self::$con->setAttribute(PDO::ATTR_PERSISTENT, false);
      } catch (PDOException $e) {
        // echo $e->getMessage();
        echo "Could not connect to the database"; exit;
      }
    }

    public static function getConnection() {
      if (!self::$con) {
        new DB();
      }
      return self::$con;
    }

  }

?>
