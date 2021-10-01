<?php 
/** Configuration ***/

	if (!defined("_VALID_PHP"))
		die('Direct access to this location is not allowed.');
		  
	/**  
	Database Constants - these constants refer to
	the database configuration settings.
	**/
		define('DB_SERVER', 'localhost'); 
		define('DB_USER', 'shipper_tahvel');  
		define('DB_PASS', '');  
		define('DB_DATABASE', 'shipper_tahvel'); 

	/** 
	Show MySql Errors.
	Not recomended for live site. true/false
	**/
		$DEBUG = true;
?>
