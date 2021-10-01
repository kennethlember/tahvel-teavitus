<?php
  define("_VALID_PHP", true);
  require_once("init.php");
?>
<?php
if ($user->logged_in) {
	redirect_to("index.php");
} else {
	require "files/register.php";
}

?>