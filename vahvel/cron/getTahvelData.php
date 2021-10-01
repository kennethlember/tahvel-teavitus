<?php
  define("_VALID_PHP", true);
  require_once("/home/shipper/public_html/tahvel/init.php");

?>
<?php
  require_once("/home/shipper/public_html/tahvel/lib/class_tahvel.php");  
  $tahvel = new Tahvel();	
  
  $classes = $db->fetch_all("SELECT * FROM class");
	foreach($classes as $cla):
	  $class = array(
		"id" => $cla["id"],
		"name" => $cla["name"],
		"link" => $cla["link"]
	  );
	  $tahvel->GetTahvelData($class);
	endforeach;

?>