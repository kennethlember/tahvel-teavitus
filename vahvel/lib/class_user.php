<?php
/** User Class **/
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
date_default_timezone_set('Europe/Tallinn');
  class Users
  {
	  private $uTable = "users";
	  public $logged_in = null;
	  public $uid = 0;
	  public $userid = 0;
      public $email;
	  public $sesid;
	  public $name;
	  private $lastlogin = "NOW()";
      

      /**
       * Users::__construct()
       * 
       * @return
       */
      function __construct()
      {
		  $this->getUserId();
		  $this->startSession();
      }

	  /**
	   * Users::getUserId()
	   * 
	   * @return
	   */
	  private function getUserId()
	  {
	  	  global $core, $DEBUG;
		  if (isset($_GET['userid'])) {
			  $userid = (is_numeric($_GET['userid']) && $_GET['userid'] > -1) ? intval($_GET['userid']) : false;
			  $userid = sanitize($userid);
			  
			  if ($userid == false) {
				  $DEBUG == true ? $core->error("You have selected an Invalid Id", "Users::getUserId()") : $core->ooops();
			  } else
				  return $this->userid = $userid;
		  }
	  }  

      /**
       * Users::startSession()
       * 
       * @return
       */
      private function startSession()
      {  
		if (strlen(session_id()) < 1)
			session_start();
		
		$this->logged_in = $this->loginCheck();
			
		if (!$this->logged_in) {
			$this->email = $_SESSION['email'] = "0";
			$this->sesid = sha1(session_id());
			$_SESSION["sesid"] = $this->sesid;
			$this->userlevel = 0;
			
		}
      }

	  /**
	   * Users::loginCheck()
	   * 
	   * @return
	   */
	  private function loginCheck()
	  {
		

          if (isset($_SESSION['email']) && $_SESSION['email'] != "0") {
              
              $row = $this->getUserInfo($_SESSION['email']);
			  $this->uid = $row['id'];
			  $this->email = $row['email'];
			  $this->fname = $row['fname'];
			  $this->lname = $row['lname'];
			  $this->admin = $row['admin'];
			  $this->classroom = $row['class'];
			  $this->name = $row['fname'] . ' ' . $row["lname"];
			  $this->sesid = sha1(session_id());
			  $_SESSION["sesid"] = $this->sesid;	
			return true;
          } else {
              return false;
          }  
	  }
	  /**
	   * Users::checkStatus()
	   * 
	   * @param mixed $email
	   * @param mixed $password
	   * @return
	   */
	  public function checkStatus($email, $password)
	  {
		  global $db;
		  
		  $email = sanitize($email);
		  $email = $db->escape($email);
		  $password = sanitize($password);
		  
          $sql = "SELECT id,password FROM " . $this->uTable
		  . "\n WHERE email = '".$email."'";
          $result = $db->query($sql);

		  $row = $db->fetch($result);
		  $entered_pass = sha1($password);

		  if ($db->numrows($result) == 0) {
			  $data["number"] = 0;
			  $data["msg"] = "Ah, mida sul pole kasutajat registeeritud ju!";
		  } else 
		  if ($entered_pass != $row["password"]) {
			  $data["number"] = 0;
			  $data["msg"] = "N00b oled vää? Su parool on täiesti vale!";			
		  }  else 
		  if ($entered_pass == $row["password"]) {
			  $data["number"] = 1;
			  $data["msg"] = "Nonii nüüd sisselogitud";			
		  } 
		  return $data;
	  }
		/**
	   * Users::LoginForm()
	   * @return
	   */
	  public function LoginForm($email,$password) {
		  global $db, $core;
			
			$status = $this->checkStatus($email, $password);

			if ($status["number"] == 0) {
				$e = $status["msg"];
			} 
		  if (empty($e) && $status["number"] == 1 ) {
			$row = $this->getUserInfo($email);
			$this->uid = $_SESSION['uid'] = $row['id'];
			$this->email = $_SESSION['email'] = $row['email'];


			
			$result["success"] = "1";
			$result["user_id"] = $this->uid;
			$result["msg"] = "success";
			echo json_encode($result,true);
		  } else {
			  $result["success"] = "0";
			  $result["msg"] = $e;
			  echo json_encode($result,true);
		  }
	  }
	  
		/**
	   * Users::getSubjects()
	   * @return
	   */
	  public function getSubjects() {
		  global $db, $core;
			
			$today = date("Y-m-d");
			$time = date("H:i:s");
			
	  if ($_GET["what"] == "#today") {
		 $ts = $db->fetch_all("SELECT * FROM data WHERE class_id = '".$this->classroom."' AND created = '".$today."' ORDER BY timeStart ASC");
		 if ($ts) {
			 $count = count($ts);
			 $result["title"] = '<h4 class="text-center margin-top-20"><strong>Sul on kokku täna '.$count.' tundi </strong></h4>';
			 $result["subject"] = '';
			foreach ($ts as $t): 
			
			
			if( strpos($t["teachers"], ",") !== false ) { 
				$tea = explode(',', $t["teachers"]);
				
				$teacher = '';
				foreach($tea as $te):
					$teacher = $teacher . ' <label class="label label-success">'.$te.'</label>';	
				endforeach;

			} else {
				$teacher = '<label class="label label-success">'.$t["teachers"].'</label>';
			}
				if ($t["timeStart"] <= $time && $t["timeEnd"] >= $time) {
					$wc = 'well-bordered';
				} else {
					$wc = '';
				}
 				
				
				$result["subject"] = $result["subject"] . '<div class="well well-light '.$wc.' well-sm margin-top-10">
							<div class="row">
								<div class="col-xs-9">
									<h4>'.$t["name"].'
										<small class="block">
										<div><i class="far fa-calendar-alt"></i> '.$t["created"].'</div>
										<div><i class="far fa-clock"></i> '.$t["timeStart"].' - '.$t["timeEnd"].'</div>
										</small>
									</h4>
								</div>
								<div class="col-xs-3 text-right">
									<h4><strong>'.$t["rooms"].'</strong></h4>
								</div>
								<div class="col-xs-12">
									'.$teacher.'
								</div>
							</div>
						</div>';
			endforeach;
		 } else {
			 $result["subject"] = '<h4 class="text-center margin-top-20">Sul ei ole ühtegi tundi rohkem täna!</h4>';
		 }
	  } else
	  if ($_GET["what"] == "#other") {
		  $ch = $db->first("SELECT * FROM data WHERE class_id = '".$this->classroom."' AND created > '".$today."' ORDER BY created DESC");
		  $nextDay = $ch["created"];
		  
		 $ts = $db->fetch_all("SELECT * FROM data WHERE class_id = '".$this->classroom."' AND created = '".$nextDay."' ORDER BY timeStart ASC");
		
		 if ($ts) {
			$count = count($ts);
			$result["title"] = '<h4 class="text-center margin-top-20"><strong>Sul on järgmine tund ('.$nextDay.') ja siis on sul kokku '.$count.' tundi</strong> </h4>';
			 $result["subject"] = '';
			foreach ($ts as $t): 
			if( strpos($t["teachers"], ",") !== false ) {
				$tea = explode(',', $t["teachers"]);
				$teacher = '';
				foreach($tea as $te):
					$teacher = $teacher . ' <label class="label label-success">'.$te.'</label>';	
				endforeach;

			} else {
				$teacher = '<label class="label label-success">'.$t["teachers"].'</label>';
			}
			
				$result["subject"] = $result["subject"] . '<div class="well well-light well-sm margin-top-10">
							<div class="row">
								<div class="col-xs-9">
									<h4>'.$t["name"].'
										<small class="block">
											<div><i class="far fa-calendar-alt"></i> '.$t["created"].'</div>
											<div><i class="far fa-clock"></i> '.$t["timeStart"].' - '.$t["timeEnd"].'</div>
										</small>
									</h4>
								</div>
								<div class="col-xs-3 text-right">
									<h4><strong>'.$t["rooms"].'</strong></h4>
								</div>
								<div class="col-xs-12">
									'.$teacher.'
								</div>
							</div>
						</div>';
			endforeach;
		 } else {
			 $result["subject"] = '<h4 class="text-center margin-top-20">Sinu tunnigraafik on täiesti tühi!</h4>';
		 }
	  }		  
echo json_encode($result,true);
		
	  }


      /**
       * Users::logout()
       * 
       * @return
       */
      public function logout()
      {
          unset($_SESSION['email']);
		  unset($_SESSION['email']);
		  unset($_SESSION['name']);
          unset($_SESSION['uid']);
          session_destroy();
		  session_regenerate_id();
          
          $this->logged_in = false;
          $this->email = "Guest";
          $this->userlevel = 0;
      }

	  /**
	   * Users::getUserInfo()
	   * 
	   * @param mixed $email
	   * @return
	   */
	  private function getUserInfo($email)
	  {
		  global $db;
		  $email = sanitize($email);
		  $email = $db->escape($email);
		  
		  $sql = "SELECT * FROM " . $this->uTable . " WHERE email = '" . $email . "'";
		  $row = $db->first($sql);
		  if (!$email)
			  return false;
		  
		  return ($row) ? $row : 0;
	  }
	  
	  /**
	   * Users::getUniqueCode()
	   * 
	   * @param string $length
	   * @return
	   */
	  private function getUniqueCode($length = "")
	  {
		  $code = md5(uniqid(rand(), true));
		  if ($length != "") {
			  return substr($code, 0, $length);
		  } else
			  return $code;
	  }

	  /**
	   * Users::generateRandID()
	   * 
	   * @return
	   */
	  private function generateRandID()
	  {
		  return sha1($this->getUniqueCode(24));
	  }
	  /**
	   * Users::generateHash()
	   * 
	   * @return
	   */
	  public function generateHash()
	  {
		  $hash = sha1($this->getUniqueCode(10));
		  return $hash;
	  }

	  /**
	   * Users::SendVerifyCode()
	   * 
	   * @return
	   */
	  public function SendVerifyCode($data)
	  {
		global $db,$core;
			
			require_once(location . "lib/class_mailer.php");
			$mail = new Mailer();
			$mailer = $mail->sendMail();	 

			$row = $core->getRowById("email_templates", 1);
			$body = str_replace(array('[USERNAME]', '[CODE]'), 
			array($data["name"], $data["code"]), $row['body']);

			$message = new Swift_Message();
			$message->setSubject($row['subject']);
			$message->setTo(array($data["email"] => $data["name"]));
			$message->setFrom(array($core->smtp_user => $core->site_name));
			$message->setBody(cleanOut($body), 'text/html');
			$mailer->send($message);
	  }
	  /**
	   * Users::Register()
	   * 
	   * @return
	   */
	  public function Register()
	  {
		global $db,$core;
		

		$checkEmail = $db->first("SELECT * FROM users WHERE email = '".$_POST["email"]."'");
		if ($checkEmail) {
			$result["success"] = "0";
			$result["msg"] = "Niisugune e-mail on juba olemas";
		} else {
			$pwd = sha1($_POST["password"]);
			$data = array(
				"email" => $_POST["email"],
				"password" => $pwd,
				"fname" => ucFirst($_POST["fname"]),
				"lname" => ucFirst($_POST["lname"]),
				"created" => "NOW()"
			);
			$id = $db->insert("users",$data);
			
			
			$this->uid = $_SESSION['uid'] = $id;
			$this->email = $_SESSION['email'] = $_POST['email'];
			$this->fname = $_SESSION['fname'] = $_POST["fname"];
			$this->lname = $_SESSION['lname'] = $_POST["lname"];
			$this->name = $_SESSION['name'] = $_POST["fname"] . ' ' . $_POST["lname"];
			
			$result["user_id"] = $this->uid;
			$result["url"] = "class.php";
			$result["success"] = "1";
		}
		echo json_encode($result,true);
	  }

	  /**
	   * Users::ChooseClass()
	   * 
	   * @return
	   */
	  public function ChooseClass()
	  {
		global $db,$core;
			
		$data = array(
			"class" => $_GET["class"]
		);
		$db->update($this->uTable, $data, "id='" . $this->uid . "'");
		
			$result["success"] = "1";
			$result["url"] = "index.php";

		echo json_encode($result,true);
	  }



	  /**
	   * Users::Verify()
	   * 
	   * @return
	   */
	  public function Verify()
	  {
		global $db,$core;
		

		$check = $db->first("SELECT * FROM users WHERE id = '".$this->uid."' AND code = '".$_POST["code"]."'");
		if ($check) {
			$data = array(
				"verify" => "1"	
			);
			$db->update($this->uTable, $data, "id='" . $this->uid . "'");
			$result["success"] = "1";
			if (isset($_POST["order_id"])) {
				$o = $db->first("SELECT * FROM order_ WHERE id = '".$_POST["order_id"]."'");
				$result["url"] = "orderStatus.php?order_id=".$o["id"]; 
			} else {
				$result["url"] = "index.php";
			}
		} else {
			$result["success"] = "0";
			$result["msg"] = "Please check 4 digits code.";
		}
		echo json_encode($result,true);
	  }
	  /**
	   * Users::UpdateProfileForm()
	   * 
	   * @return
	   */
	  public function UpdateProfileForm()
	  {
		global $db,$core;
		
		$c = $db->first("SELECT * FROM users WHERE email = '".$_POST["email"]."' AND id != '".$this->uid."'");
		if ($c) {
			$result["success"] = "0";
			$result["msg"] = "Please choose different e-mail address.";
		} else {
			$data = array(
				"fname" => $_POST["fname"],
				"lname" => $_POST["lname"],
				"email" => $_POST["email"]
			);
			$db->update($this->uTable, $data, "id='" . $this->uid . "'");
			$result["success"] = "1";
			$result["msg"] = "Your profile is updated!";
		}
		echo json_encode($result,true);
	  }
	  /**
	   * Users::ChangePasswordForm()
	   * 
	   * @return
	   */
	  public function ChangePasswordForm()
	  {
		global $db,$core;
		
		$c = $db->first("SELECT * FROM users WHERE id = '".$this->uid."'");
		
		$oldpwd = sha1($_POST["password"]);
		$newpwd = sha1($_POST["pwd1"]);
		
		if ($c["password"] == $oldpwd) {
			$data = array(
				"password" => $newpwd
			);
			$db->update($this->uTable, $data, "id='" . $this->uid . "'");
			$result["success"] = "1";
			$result["msg"] = "Your password is changed";			
		} else {
			$result["success"] = "0";
			$result["msg"] = "Your old password is wrong";
		}
		echo json_encode($result,true);
 	  }
	  
	  /**
	   * Users::ChangeAvatarForm()
	   * 
	   * @return
	   */
	  public function ChangeAvatarForm()
	  {
		global $db,$core;
		
			if(isset($_FILES['avatar'])) {
				$result["success"] = "1";

				$file_name = $_FILES['avatar']['name'];
				$file_size =$_FILES['avatar']['size'];
				$file_tmp =$_FILES['avatar']['tmp_name'];
				$file_type=$_FILES['avatar']['type'];

				$tmp = explode('.', $_FILES['avatar']['name']);
				$file_ext = end($tmp); 

				$extensions= array("jpeg","jpg","png");
		  
				if(in_array($file_ext,$extensions)=== false){
					$result["success"] = "0";
					$result["msg"] = "extension not allowed, please choose a JPEG or PNG file.";
				}
				if($file_size > 2097152){
					$result["success"] = "0";
					$result["msg"] = "File size must be smaller than 2 MB";
				}
		  
				if($result["success"] == "1"){
					$path = $core->site_dir.'uploads/user/'.$this->uid.'/avatar/';
					$url = $core->site_url.'uploads/user/'.$this->uid.'/avatar/';

					if (!file_exists($path)) {
						mkdir($path, 0777, true);
					}
					$code = rand(1000, 99999);
					$fileName = $code.'.'.$file_ext;
					move_uploaded_file($file_tmp,$path.$fileName);
					
					$data = array(
						"avatar" => $fileName
					);
					$db->update($this->uTable, $data, "id='" . $this->uid . "'");
				
					$result["avatar"] = $url.$fileName;
					$result["success"] = "1";
					$result["msg"] = "Profile picture updated";
				}
			} else {
				$result["success"] = "0";
				$result["msg"] = "Please choose picture also!";
			}
		echo json_encode($result,true);	
	  }
	  /**
	   * Users::bankAccountAddForm()
	   * 
	   * @return
	   */
	  public function bankAccountAddForm()
	  {
		global $db,$core;
		
		$c = $db->first("SELECT * FROM users WHERE id = '".$this->uid."'");
		
		
			$data = array(
				"bank_name" => $_POST["name"],
				"bank_account" => $_POST["iban"]
			);
			$db->update($this->uTable, $data, "id='" . $this->uid . "'");
			$result["success"] = "1";

		if ($c["bank_account"]) {
			$result["msg"] = "Your bank account edited.";			
		} else {
			$result["msg"] = "Your bank account added.";			
		}

		echo json_encode($result,true);
 	  }
	  /**
	   * Users::ContactSupportForm()
	   * 
	   * @return
	   */
	  public function ContactSupportForm()
	  {
		global $db,$core;
		
			$data = array(
				"user_id" => $this->uid,
				"subject" => $_POST["subject"],
				"message" => $_POST["message"],
				"created" => "NOW()"
			);
			$db->insert("support_contact",$data);
			
			$result["success"] = "1";
			$result["msg"] = "Your support request sent! We will contact you soon as possible!";			
		echo json_encode($result,true);
 	  }
	  /**
	   * Users::CheckIfUserFirstTime()
	   * 
	   * @return
	   */
	  public function CheckIfUserFirstTime()
	  {
		global $db,$core;
		
		$result["code"] = $this->getUniqueCode();
		
		echo json_encode($result,true);
 	  }
	  /**
	   * Users::ForgotpwdForm()
	   * 
	   * @return
	   */
	  public function ForgotpwdForm()
	  {
		global $db,$core;
		
		$email = $_POST["email"];
		$u = $db->first("SELECT * FROM users WHERE email = '".$email."'");
		if ($u) {
			
		$newPWD = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789') , 0 , 8);
		$shaPWD = sha1($newPWD);
			
			$data = array(
				"password" => $shaPWD
			);
			$db->update($this->uTable, $data, "email='" . $email . "'");
			
			require_once(location . "lib/class_mailer.php");
			$mail = new Mailer();
			$mailer = $mail->sendMail();	 

			$row = $core->getRowById("email_templates", 10);
			$body = str_replace(array('[CODE]'), 
			array($newPWD), $row['body']);

			$message = new Swift_Message();
			$message->setSubject($row['subject']);
			$message->setTo(array($u["email"] => $u["fname"].' '.$u["lname"]));
			$message->setFrom(array($core->smtp_user => $core->site_name));
			$message->setBody(cleanOut($body), 'text/html');
			$mailer->send($message);
			$result["success"] = "1";
			$result["msg"] = "Your password is changed, please check your e-mail!";
		} else {
			$result["success"] = "0";
			$result["msg"] = "No such user!";
		}
		echo json_encode($result,true);
 	  }
	  /**
	   * Users::RegisterFirebaseToken()
	   * 
	   * @return
	   */
	  public function RegisterFirebaseToken()
	  {
		global $db,$core,$user;
		
		if ($user->logged_in) {
			$check = $db->first("SELECT * FROM firebase_tokens WHERE user_id = '".$user->uid."'");
			if (!$check) {
			$user_id = $this->uid;
			$data = array(
				"user_id" => $user_id,
				"token" => $_POST["token"],
				"type" => $_POST["type"],
				"created" => "NOW()"
			);
			$db->insert("firebase_tokens",$data);
			}
		} 

		}

	  /**
	   * Users::SetUserIDtoFirebaseToken()
	   * 
	   * @return
	   */
	  public function SetUserIDtoFirebaseToken()
	  {
		global $db,$core;

		$check = $db->first("SELECT * FROM firebase_tokens WHERE token = '".$_POST["token"]."' AND type = '".$_POST["type"]."'");
		
		if ($check) {
		if ($check["user_id"] == "0") {
			$data = array(
				"user_id" => $_POST["user_id"]
			);
			$db->update("firebase_tokens", $data, "id='" . $check["id"] . "'");
		} 
		} else {
			$data = array(
				"user_id" => $_POST["user_id"],
				"token" => $_POST["token"],
				"type" => $_POST["type"],
				"created" => "NOW()"
			);
			$db->insert("firebase_tokens",$data);
		}
	  }
	  /**
	   * Users::CheckIfUserLoggedIN()
	   * 
	   * @return
	   */
	  public function CheckIfUserLoggedIN()
	  {
		global $db,$core;
		
		$user_id = $_GET["user_id"];
		$u = $db->first("SELECT * FROM users WHERE id = '".$user_id."'");
		if ($u && !$this->logged_in) {
			$this->uid = $_SESSION["uid"] = $u["id"];
			$this->email = $_SESSION["email"] = $u["email"];
			$result["success"] = "1";
		} else {
			$result["success"] = "0";
		}
		echo json_encode($result,true);
 	  }
	  }	
?>