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
  // Make sure user doesn't exist
  $findUser = $con->prepare("SELECT user_id, password FROM users WHERE email = :email LIMIT 1");
  $findUser->bindParam(":email", $email, PDO::PARAM_STR);
  $findUser->execute();

  if ($findUser->rowCount() == 1) {
    // User exists, try and sign in the user
    // Check if the user is able to log in
    $User = $findUser->fetch(PDO::FETCH_ASSOC);

    $user_id = (int) $User["user_id"];
    $hash = (string) $User["password"];

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