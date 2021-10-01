<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
/** Sendinblue Class **/
    require __DIR__ . '/sendinblue/autoload.php';
	use \Firebase\JWT\JWT;
 
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');

  class Sendinblue
  {
	private $access_key = '';

      /**
       * Sendinblue::__construct()
       * 
       * @return
       */
      function __construct()
      {
      }

	  
  	  /**
	   * Sendinblue::SendEmail()
	   * 
	   * @return
	   */
	  public function SendEmail($data) {
		global $db,$core,$user;
		
		$config = SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('api-key', $this->access_key);

		$apiInstance = new SendinBlue\Client\Api\TransactionalEmailsApi(
			new GuzzleHttp\Client(),
			$config
		);
		$sendSmtpEmail = new \SendinBlue\Client\Model\SendSmtpEmail();
		$sendSmtpEmail['to'] = array(array('email'=>$data["to"], 'name'=>$data["name"]));
		$sendSmtpEmail['templateId'] = 10;
		$sendSmtpEmail['params'] = array('lesson'=>$data["lesson"],'date'=>$data["date"],'start'=>$data["start"],'end'=>$data["end"],'rooms'=>$data["rooms"],'teachers'=>$data["teachers"]);
		$sendSmtpEmail['headers'] = array('X-Mailin-custom'=>'custom_header_1:custom_value_1|custom_header_2:custom_value_2');

		try {
			$result = $apiInstance->sendTransacEmail($sendSmtpEmail);
		} catch (Exception $e) {
			echo 'Exception when calling TransactionalEmailsApi->sendTransacEmail: ', $e->getMessage(), PHP_EOL;
		}
		
	  }  
	  

	  }	
?>
