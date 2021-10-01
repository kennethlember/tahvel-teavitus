<?php
  define("_VALID_PHP", true);
  require_once("init.php");
?>
<?php
// Unset all of the session variables.
$_SESSION = array();


// Finally, destroy the session.
session_destroy();
 redirect_to("index.php");
?>