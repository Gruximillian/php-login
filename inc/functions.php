<?php
// Force the user to log in
function ForceLogin() {
  if (isset($_SESSION["user_id"])) {
    // The user is allowed here
  } else {
    // The user is not allowed here
    header("Location: /php-login/login.php"); exit;
  }
}

function ForceDashboard() {
  if (isset($_SESSION["user_id"])) {
    // The user is allowed here but redirect anyway
    header("Location: /php-login/dashboard.php"); exit;
  } else {
    // The user is not allowed here
  }
}

?>
