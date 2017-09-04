<?php

  // Allow the config
  define("__CONFIG__", true);
  // Require the config
  require_once "../inc/config.php";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Always return JSON format
    header("Content-type: application/json");
    $return = [];

    $email = Filter::String($_POST["email"]);
    $password = $_POST["password"];

    $user_found = User::Find($email, true);

    if ($user_found) {
      // User exists, try and sign in the user
      // Check if the user is able to log in
      $user_id = (int) $user_found["user_id"];
      $hash = (string) $user_found["password"];

      if (password_verify($password, $hash)) {
        // User is signed in
        $return["redirect"] = "/dashboard.php";
        $_SESSION["user_id"] = $user_id;
      } else {
        // Invalid user info
        $return["error"] = "Invalid email/password combination!";
      }

    } else {
      // User does not exist, needs to create an account
      $return["error"] = "You do not have an account. <a href=\"register.php\">Create one now?</a>";
    }

    echo json_encode($return, JSON_PRETTY_PRINT); exit;
  } else {
    exit("Not allowed!");
  }

?>
