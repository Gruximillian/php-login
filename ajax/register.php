<?php

// Allow the config
define("__CONFIG__", true);
// Require the config
require_once "../inc/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Always return JSON format
  header("Content-type: application/json");
  $data = [];

  $data["redirect"] = "/dashboard.php";

  echo json_encode($data, JSON_PRETTY_PRINT); exit;
} else {
  exit("Not allowed!");
}


?>
