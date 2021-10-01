<?php
  define("_VALID_PHP", true);
  require_once("init.php");
?>
<?php
if ($user->logged_in) {
	require "files/index.php";
} else {
	require "files/login.php";
}

?>