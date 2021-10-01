<?php
/** Core Class **/
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
  
  class Core {
	  private $sTable = "settings";
	  public $fee = 2.5;
	  
      /**
       * Core::__construct()
       * 
       * @return
       */
      public function __construct() {
          $this->getSettings();
      }
      
      /**
       * Core::getSettings()
       *
       * @return
       */
      private function getSettings()
      {
          global $db;
          $sql = "SELECT * FROM " . $this->sTable;
          $row = $db->first($sql);
		  $this->site_name = $row["site_name"];
          $this->site_logo = $row["site_logo"];
		  $this->site_url = $row["site_url"];
		  $this->site_dir = $row["site_dir"];
		  $this->site_email = $row["site_email"];
		  
		$this->smtp_host = $row["smtp_host"];
        $this->smtp_user = $row["smtp_user"];
        $this->smtp_pass = $row["smtp_pass"]; 
        $this->smtp_port = $row["smtp_port"];
        $this->is_ssl = $row["smtp_ssl"];        
		  }

      /**
       * Core::GetFee()
       *
       * @return
       */
      public function GetFee($price)
      {
          global $db,$user;
		  
		if ($price >= 40) {
			$per = 2.5;
		} else {
			$per = $this->fee;
		}
		
		
		$fee = ($per / 100) * $price;
		if ($fee < 1) {
			$fee = $this->fee;
		}			
		$fee = number_format((float)$fee, 2, '.', '');
		return $fee; 
	  }
      /**
       * Core::GetPrice()
       *
       * @return
       */
      public function GetPrice($order_id)
      {
          global $db,$user;
		
		$o = $db->first("SELECT * FROM order_ WHERE id = '".$order_id."'");
		
		$price = $o["price"];
		
		if ($price >= 40) {
			$per = 2.5;
		} else {
			$per = $this->fee;
		}
		
		
		$fee = ($per / 100) * $price;
		if ($fee < 1) {
			$fee = $this->fee;
		}			
		$fee = number_format((float)$fee, 2, '.', '');
		
		$result["total"] = $fee + $price;
		$result["fee"] = $fee;
		$result["price"] = $price;
		return $result;
	  }

      /**
       * Core::GetUserActivity()
       *
       * @return
       */
      public function GetUserActivity()
      {
          global $db,$user;
			
			$act =  $db->fetch_all("SELECT * FROM activity WHERE user_id = '".$user->uid."' OR seller_id = '".$user->uid."' OR buyer_id = '".$user->uid."'");
		if ($act) {
		$i = 0;
		foreach ($act as $ac):
			
			if ($ac["type"] == "1") {
				$icon = '<i class="fal fa-cubes"></i>';
				$msg = $this->GetUserActivityDesc($ac["type"],$ac["activity_id"]);
				
				$o = $db->first("SELECT * FROM order_ WHERE id = '".$ac["order_id"]."'"); 
				$seller = $db->first("SELECT * FROM users WHERE id = '".$o["seller_id"]."'");
				$buyer = $db->first("SELECT * FROM users WHERE id = '".$o["buyer_id"]."'");
				
				if ($o["seller_id"] == $ac["user_id"]) {
					$username = $seller["fname"] . ' ' . $seller["lname"];
					$side = "Seller";
				} else
				if ($o["buyer_id"] == $ac["user_id"]) {
					$username = $buyer["fname"] . ' ' . $buyer["lname"];				
					$side = "Buyer";
				} 
				
				$body = str_replace(array('[ORDERLINK]', '[ORDER]','[USERNAME]','[SIDE]'), 
					array('orderStatus.php?order_id='.$o["id"], $o["product"],$username,$side), $msg);
				
				$result[$i]["icon"] = $icon;
				$result[$i]["msg"] = $body;
			}
		$i++;
		endforeach;
		} else {
			$result["success"] = "0";
		}
		  
		  return $result;
	  }
/**
       * Core::SaveUserActivity()
       *
       * @return
       */
      public function SaveUserActivity($order_id,$type,$activity_id)
      {
          global $db,$user;
			
		$o = $db->first("SELECT * FROM order_ WHERE id = '".$order_id."'");
		$seller = $db->first("SELECT * FROM users WHERE id = '".$o["seller_id"]."'");
		$buyer = $db->first("SELECT * FROM users WHERE id = '".$o["buyer_id"]."'");

		$data = array(
			"order_id" => $o["id"],
			"user_id" => $user->uid,
			"seller_id" => $seller["id"],
			"buyer_id" => $buyer["id"],
			"type" => $type,
			"activity_id" => $activity_id,
			"created" => "NOW()"
		);
		$db->insert("activity",$data);

		}
      /**
       * Core::GetOrderActivity()
       *
       * @return
       */
      public function GetOrderActivity($order_id)
      {
          global $db,$user;
			
			$act =  $db->fetch_all("SELECT * FROM activity WHERE order_id = '".$order_id."' AND (user_id = '".$user->uid."' OR seller_id = '".$user->uid."' OR buyer_id = '".$user->uid."') ORDER BY created ASC");
		if ($act) {
		$i = 0;
		foreach ($act as $ac):
			
			if ($ac["type"] == "1") {
				$icon = '<i class="fal fa-cubes"></i>';
				$msg = $this->GetUserActivityDesc($ac["type"],$ac["activity_id"]);
				
				$o = $db->first("SELECT * FROM order_ WHERE id = '".$ac["order_id"]."'"); 
				$seller = $db->first("SELECT * FROM users WHERE id = '".$o["seller_id"]."'");
				$buyer = $db->first("SELECT * FROM users WHERE id = '".$o["buyer_id"]."'");
				
				if ($o["seller_id"] == $ac["user_id"]) {
					$username = $seller["fname"] . ' ' . $seller["lname"];
					$side = "Seller";
				} else
				if ($o["buyer_id"] == $ac["user_id"]) {
					$username = $buyer["fname"] . ' ' . $buyer["lname"];				
					$side = "Buyer";
				} 
				
				$body = str_replace(array('[ORDERLINK]', '[ORDER]','[USERNAME]','[SIDE]'), 
					array('orderStatus.php?order_id='.$o["id"], $o["product"],$username,$side), $msg);
				
				$result[$i]["icon"] = $icon;
				$result[$i]["msg"] = $body;
				$result[$i]["time"] = $ac["created"];
			}
		$i++;
		endforeach;
		} else {
			$result["success"] = "0";
		}
		  
		  return $result;
	  }
      /**
       * Core::GetUserActivityDesc()
       *
       * @return
       */
      public function GetUserActivityDesc($type,$activity_id)
      {
          global $db,$user;
	  
		if ($type == "1") {
			$data = array(
				"1" => "Order <a href='[ORDERLINK]'><strong>([ORDER])</strong></a> created by <strong>[USERNAME]</strong> ([SIDE])",
				"2" => "Order <a href='[ORDERLINK]'><strong>([ORDER])</strong></a> accepted by <strong>[USERNAME]</strong> ([SIDE])",
				"3" => "Order <a href='[ORDERLINK]'><strong>([ORDER])</strong></a> confirmed by <strong>[USERNAME]</strong> ([SIDE])",
				"4" => "<strong>[USERNAME]</strong> ([SIDE]) left your order <a href='[ORDERLINK]'><strong>([ORDER])</strong></a> feedback.",
				"5" => "Order <a href='[ORDERLINK]'><strong>([ORDER])</strong></a> rejected by <strong>[USERNAME]</strong> ([SIDE])",
				"6" => "Order <a href='[ORDERLINK]'><strong>([ORDER])</strong></a> canceled by <strong>[USERNAME]</strong> ([SIDE])",
				"7" => "Order <a href='[ORDERLINK]'><strong>([ORDER])</strong></a> finished."
			);
		} else 
		if ($type == "2") {
			$data = array(
				"1" => "Order <a href='[ORDERLINK]'><strong>([ORDER])</strong></a> shipped by <strong>[USERNAME]</strong> ([SIDE])",
				"2" => "Order <a href='[ORDERLINK]'><strong>([ORDER])</strong></a> delivered to <strong>[USERNAME]</strong> ([SIDE])",
				"3" => "Order <a href='[ORDERLINK]'><strong>([ORDER])</strong></a> received by <strong>[USERNAME]</strong> ([SIDE])"
			);
		} else 
		if ($type == "3") {
			$data = array(
				"1" => "Order <a href='[ORDERLINK]'><strong>([ORDER])</strong></a> paid by <strong>[USERNAME]</strong> ([SIDE])",
				"2" => "Shipper fee paid by order <a href='[ORDERLINK]'><strong>([ORDER])</strong></a>",
				"3" => "[USERNAME] ([SIDE]) relased your order <a href='[ORDERLINK]'><strong>([ORDER])</strong></a> money.",
				"4" => "Your withdrawled money.",
				"5" => "Shipper fee paid by withdrawl."
			);
		}
		  
		  return $data[$activity_id];		
	  
	  }
      /**
       * Core::GetOrderActivityDesc()
       *
       * @return
       */
      public function GetOrderActivityDesc($activity_id)
      {
          global $db,$user;
		  
		  $data = array(
			"1" => "Order created",
			"2" => "Both sides accepted this order.",
			"3" => "Buyer paid for this order",
			"4" => "Seller ordered shipment.",
			"5" => "Seller shipped this order.",
			"6" => "Order delivered buyer destination.",
			"7" => "Order received by buyer.",
			"8" => "Order accepted and money relased.",
			"9" => "Order dispute started.",
			"10" => "Order canceled."
		  );
		  
		  return $data[$activity_id];
	  }
      /**
       * Core::DisputeMessageDesc()
       *
       * @return
       */
      public function DisputeMessageDesc($activity_id)
      {
          global $db,$user;
		  
		  $data = array(
			"1" => "Dispute started",
			"2" => "Ship back",
			"3" => "Smaller price",
			"4" => "No agreement",
			"5" => "Shipper resolve",
			"6" => "Money to Seller",
			"7" => "Money to Buyer"
		  );
		  
		  return $data[$activity_id];
	  }
      /**
       * Core::MoneyActivityDesc()
       *
       * @return
       */
      public function MoneyActivityDesc($activity_id)
      {
          global $db,$user;
		  
		  $data = array(
			"1" => "Order paid, money reserved",
			"2" => "Order canceled, money returned buyer.",
			"3" => "Money relased to seller",
			"4" => "Withdrawl request sent",
			"5" => "Money sent to bank account"
		  );

		  return $data[$activity_id];
	  }
	/**
       * getRowById()
       * 
       * @param mixed $table
       * @param mixed $id
       * @param bool $and
       * @param bool $is_admin
       * @return
       */
      public function getRowById($table, $id, $and = false, $is_admin = true)
      {
          global $db;
		  $id = sanitize($id, 8, true);
		  if ($and) {
			  $sql = "SELECT * FROM " . (string)$table . " WHERE id = '" . $db->escape((int)$id) . "' AND " . $db->escape($and) . "";
		  } else
			  $sql = "SELECT * FROM " . (string)$table . " WHERE id = '" . $db->escape((int)$id) . "'";
		  
          $row = $db->first($sql);
          
		  if ($row) {
			  return $row;
		  } else {
			  if ($is_admin)
				  $this->error("You have selected an Invalid Id - #".$id, "Core::getRowById()");
		  }
	  }
        /**
       * Core::SendNotificationEmail()
       *
       * @return
       */
      public function SendNotificationEmail($data)
      {
          global $db,$user;
		 
		 
			
			require_once(location . "lib/class_mailer.php");
			$mail = new Mailer();
			$mailer = $mail->sendMail();	 

			$row = $this->getRowById("email_templates", $data["id"]);
			$body = str_replace(array('[USERNAME]', '[PRODUCTNAME]','[ORDERLINK]'), 
			array($data["username"], $data["product"],$data["link"]), $row['body']);

			$message = new Swift_Message();
			$message->setSubject($row['subject']);
			$message->setTo(array($data["email"] => "Shipper"));
			$message->setFrom(array($this->smtp_user => $this->site_name));
			$message->setBody(cleanOut($body), 'text/html');
			$mailer->send($message);

	  }
  }
?>