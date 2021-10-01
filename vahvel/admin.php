<?php
  define("_VALID_PHP", true);
  require_once("init.php");
?>
<?php
if ($user->admin) {
	require "files/admin.php";
} else {
	redirect_to("index.php");
}

?>