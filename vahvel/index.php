<?php
  define("_VALID_PHP", true);
  require_once("init.php");
?>
<?php
if ($user->logged_in) {
	if (!$user->classroom) {
		require "files/class.php";		
	} else {
		require "files/index.php";
	}
} else {
	require "files/landing.php";
}

?>