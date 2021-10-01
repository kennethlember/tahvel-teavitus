<?php
/** Tahvel Class **/
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');

  class Tahvel
  {
		public $url = 'https://tahvel.edu.ee/hois_back/timetableevents/timetableByGroup/38?studentGroups='; 

      /**
       * Tahvel::__construct()
       * 
       * @return
       */
      function __construct()
      {
      }

	  /**
	   * Tahvel::GetTahvelData()
	   * 
	   * @return
	   */ 
	  public function GetTahvelData($class)
	  {
		global $db,$core;
		
		
		$gdata = url_get_contents($this->url.$class["link"].'&from='.date("Y-m-d").'T00:00:00Z');
		
		$json = json_decode($gdata);
		$json = arrayCastRecursive($json);

		foreach($json["timetableEvents"] as $j):
			if ($j["nameEt"]) {
			if ($j["teachers"]) {
			$cr = '';
			$i=0;
			foreach ($j["teachers"] as $tea):
				if ($i == "0") {
					$cr = $tea["name"];
				} else {
					$cr = $cr . ','. $tea["name"];
				}
			$i++;
			endforeach;
			
			} else {
				$cr = '';
			}
			
			if (isset($j["rooms"]["0"])) {
				$room = $j["rooms"]["0"]["roomCode"];
			} else {
				$room = '';
			}
			
			$data = array(
				"uid" => $j["id"],
				"class_id" => $class["id"],
				"created" => $j["date"],
				"timeStart" => $j["timeStart"],
				"timeEnd" => $j["timeEnd"],
				"name" => $j["nameEt"],
				"rooms" => $room,
				"teachers" => $cr,
				"changed" => $j["changed"],
				"email" => "0",
				"noty" => "0"
			);
			$check = $db->first("SELECT * FROM data WHERE uid = '".$j["id"]."'");
			if ($check) {
				if ($check["changed"] != $j["changed"]) {
					$db->update("data", $data, "id='" . $j["id"] . "'");
				}
				 
			} else {
				$db->insert("data",$data);
			}
			}
		endforeach;

 	  }
	  }	
?>