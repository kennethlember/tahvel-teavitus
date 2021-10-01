<?php
  define("_VALID_PHP", true);
  require_once("/home/shipper/public_html/tahvel/init.php");
?>
<?php
  require_once("/home/shipper/public_html/tahvel/lib/class_firebase.php");  
  $firebase = new Firebase();  
  
  $news = $db->fetch_all(" 
  SELECT 
  a.id,c.token as token
  FROM data AS a
  LEFT JOIN users AS b ON b.class = a.class_id
  LEFT JOIN firebase_tokens AS c ON c.user_id = b.id
  WHERE a.noty = 0"); 
  if ($news) {
  $i=0;
  foreach($news as $new):
		$token = $new["token"];
		$tit = 'Su tunniplaan on muutunud!';
		$body = 'Mine ja vaata järele!';
		$firebase->sendUserMessage($token,$tit,$body);

		$e = $db->first("SELECT noty FROM stats");
		$coo = $e["noty"] + 1;
		$data = array("noty"=> $coo);
		$db->update("stats", $data, "id=1");

	$ids[] = $new["id"]; 
	$i++;
  endforeach;
  
  foreach ($ids as $ii):
	$data = array("noty" => "1");
	$db->update("data", $data, "id='" . $ii . "'");
  endforeach; 
  }
?>