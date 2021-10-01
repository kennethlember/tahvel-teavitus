<?php
/**
* Mailer Class
*
* @package CMS Pro
* @author wojoscripts.com
* @copyright 2010
* @version $Id: class_mailer.php, v2.00 2011-04-20 10:12:05 gewa Exp $
*/
  
if (!defined("_VALID_PHP")) {
    
    die('Direct access to this location is not allowed.');
    
}

class Mailer {
    
    private $sitename;
    private $mailer;
    private $smtp_host;
    private $smtp_user;
    private $smtp_pass;
    private $smtp_port;
    private $sendmail;
    private $is_ssl;
	   
    /**
    * Mailer::__construct()
    */
    function __construct() {
        
        global $core;
          
        $this->sitename = $core->site_name;
        $this->mailer = "SMAIL";
        $this->sendmail = "/usr/sbin/sendmail -t -i";
        $this->smtp_host = $core->smtp_host;
        $this->smtp_user = $core->smtp_user;
        $this->smtp_pass = $core->smtp_pass;
        $this->smtp_port = $core->smtp_port;
        $this->is_ssl = $core->is_ssl;        
    }
	  
    /**
    * Mailer::sendMail()
    * 
    * Sends a various messages to users
    * 
    */
    public function sendMail() {

        require_once (location . 'lib/swift/autoload.php');
        if ($this->mailer == "SMTP") {
            
            $SSL = ($this->is_ssl) ? 'ssl' : null;
	    
            $transport = new Swift_SmtpTransport($this->smtp_host, $this->smtp_port, "ssl");
               $transport->setUsername($this->smtp_user);
               $transport->setPassword($this->smtp_pass);
			   $transport->setTimeout(120);
                 
        } else if ($this->mailer == "SMAIL") {
			$transport = new Swift_SmtpTransport($this->sendmail);  
            
        } else {
            
            $transport = new Swift_MailTransport();
        
        }
		$transport = new Swift_SendmailTransport($this->sendmail);
         $r = new Swift_Mailer($transport);
        return $r;
        
    }
	  
}

$mail = new Mailer();

?>
