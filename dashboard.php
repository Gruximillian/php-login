<?php

// Allow the config
define("__CONFIG__", true);
// Require the config
require_once "inc/config.php";

echo $_SESSION["user_id"] . " is your id";
exit;
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>PHP Login System</title>
  <!-- UIkit CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.28/css/uikit.min.css" />
</head>
<body>

  <div class="uk-section uk-container">
    <?php
      echo "Howdy! Today is: ";
      echo date("Y m d");
    ?>
    <p>
      <a href="login.php">Login </a>
      <a href="register.php"> Register</a>
    </p>
  </div>

  <?php require_once("inc/footer.php"); ?>

</body>
</html>
