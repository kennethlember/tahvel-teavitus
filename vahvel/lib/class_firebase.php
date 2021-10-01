<?php
require __DIR__ . '/firebase/autoload.php'; 

use sngrl\PhpFirebaseCloudMessaging\Client;
use sngrl\PhpFirebaseCloudMessaging\Message;
use sngrl\PhpFirebaseCloudMessaging\Recipient\Device;
use sngrl\PhpFirebaseCloudMessaging\Notification;

/** Firebase Class **/
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');

  class Firebase
  {
	  private $apikey = "";

      /**
       * Firebase::__construct()
       * 
       * @return
       */
      function __construct()
      {
      }


	  /**
	   * Firebase::sendUserMessage($user_id,$msg_id)
	   * 
	   * @return
	   */
	  public function sendUserMessage($token,$tit,$body)
	  {
		global $user,$db,$core;
		


		$client = new Client();
		$client->setApiKey($this->apikey);
		$client->injectGuzzleHttpClient(new \GuzzleHttp\Client());

		$message = new Message();
		$message->setPriority("normal");
		$message->addRecipient(new Device($token));
		$message->setNotification(new Notification($tit, $body));
		$message->setData(array(
			"title" => $tit,
			"body"  => $body,
		));
		try {
			$response = $client->send($message);
		} catch (Exception $e) {
			echo $e->getMessage();
		}

	  }
	  }	
?>
