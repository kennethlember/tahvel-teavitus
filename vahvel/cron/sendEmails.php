<?php
  define("_VALID_PHP", true);
  require_once("/home/shipper/public_html/tahvel/init.php");
?>
<?php
require_once("/home/shipper/public_html/tahvel/lib/class_sendinblue.php");  
$sendin = new Sendinblue();

  
  $news = $db->fetch_all(" 
  SELECT 
  a.id, a.created as date, a.timeStart,a.timeEnd,a.name,a.rooms,a.teachers,
  b.id as user_id,b.fname,b.lname,b.email,
  c.token as token
  FROM data AS a
  LEFT JOIN users AS b ON b.class = a.class_id
  LEFT JOIN firebase_tokens AS c ON c.user_id = b.id
  WHERE a.email = 0"); 

if ($news) {
  $i=0;
  foreach($news as $new):
  
	if ($new["email"]) {
		$data = array(
			"to" => $new["email"],
			"name" => $new["fname"] . ' ' . $new["lname"],
			"lesson" => $new["name"],
			"date" => $new["date"],
			"start" => $new["timeStart"],
			"end" => $new["timeEnd"],
			"rooms" => $new["rooms"],
			"teachers" => $new["teachers"]
		);
		$sendin->SendEmail($data);
		
		$e = $db->first("SELECT email FROM stats");
		$coo = $e["email"] + 1;
		$data = array("email"=> $coo);
		$db->update("stats", $data, "id=1");
		
	}	
	$ids[] = $new["id"]; 
	$i++;
  endforeach;
  foreach ($ids as $ii):
	$data = array("email" => "1");
	$db->update("data", $data, "id='" . $ii . "'");
  endforeach; 
}
?>