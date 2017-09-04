<?php

  // On older php versions (< 5.6), the session_destroy() did not work properly
  // So, to get rid of the session, it had to be made as expired, therefore
  // the variable $past is set to the past time
  // $past = time() - 3600;

  // Resetting the session
  session_start();
  session_destroy();
  session_write_close();
  setcookie(session_name(), "", 0, "/");
  session_regenerate_id(true);

  header("Location: /php-login/index.php");

?>
