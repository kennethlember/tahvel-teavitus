<?php
/**	User **/
  define("_VALID_PHP", true);
  require_once("../init.php");
?>
<?php
  /* NewOrderForm */
  if (isset($_POST['orderNewForm']))
      : if (intval($_POST['orderNewForm']) == 0 || empty($_POST['orderNewForm']))
      : redirect_to("../index.php");
  endif;
  $order->orderNew();
  endif;
?>
<?php
  /* GetCourierLocations */
  if (isset($_GET['GetCourierLocations']))
      : if (intval($_GET['GetCourierLocations']) == 0 || empty($_GET['GetCourierLocations']))
      : redirect_to("../index.php");
  endif;
  $order->GetCourierLocations();
  endif;
?>

<?php
  /* SendEmailBuyerForm */
  if (isset($_POST['SendEmailBuyerForm']))
      : if (intval($_POST['SendEmailBuyerForm']) == 0 || empty($_POST['SendEmailBuyerForm']))
      : redirect_to("../index.php");
  endif;
  $order->SendEmailBuyerForm();
  endif;
?>
<?php
  /* RejectOrderForm */
  if (isset($_POST['RejectOrderForm']))
      : if (intval($_POST['RejectOrderForm']) == 0 || empty($_POST['RejectOrderForm']))
      : redirect_to("../index.php");
  endif;
  $order->RejectOrderForm();
  endif;
?>
<?php
  /* AcceptOrderForm */
  if (isset($_POST['AcceptOrderForm']))
      : if (intval($_POST['AcceptOrderForm']) == 0 || empty($_POST['AcceptOrderForm']))
      : redirect_to("../index.php");
  endif;
  $order->AcceptOrderForm();
  endif;
?>
<?php
  /* CheckOrderStatusChange */
  if (isset($_GET['CheckOrderStatusChange']))
      : if (intval($_GET['CheckOrderStatusChange']) == 0 || empty($_GET['CheckOrderStatusChange']))
      : redirect_to("../index.php");
  endif;
  $order->CheckOrderStatusChange();
  endif;
?>
<?php
  /* orderShippingForm */
  if (isset($_POST['orderShippingForm']))
      : if (intval($_POST['orderShippingForm']) == 0 || empty($_POST['orderShippingForm']))
      : redirect_to("../index.php");
  endif;
  $order->orderShippingForm();
  endif;
?>
<?php
  /* OrderShipped */
  if (isset($_GET['OrderShipped']))
      : if (intval($_GET['OrderShipped']) == 0 || empty($_GET['OrderShipped']))
      : redirect_to("../index.php");
  endif;
  $order->OrderShipped();
  endif;
?>
<?php
  /* OrderReceived */
  if (isset($_GET['OrderReceived']))
      : if (intval($_GET['OrderReceived']) == 0 || empty($_GET['OrderReceived']))
      : redirect_to("../index.php");
  endif;
  $order->OrderReceived();
  endif;
?>
<?php
  /* RelaseMoneyForm */
  if (isset($_POST['RelaseMoneyForm']))
      : if (intval($_POST['RelaseMoneyForm']) == 0 || empty($_POST['RelaseMoneyForm']))
      : redirect_to("../index.php");
  endif;
  $order->RelaseMoneyForm();
  endif;
?>
<?php
  /* GiveFeedbackForm */
  if (isset($_POST['GiveFeedbackForm']))
      : if (intval($_POST['GiveFeedbackForm']) == 0 || empty($_POST['GiveFeedbackForm']))
      : redirect_to("../index.php");
  endif;
  $order->GiveFeedbackForm();
  endif;
?>
<?php
  /* CancelOrder */
  if (isset($_GET['CancelOrder']))
      : if (intval($_GET['CancelOrder']) == 0 || empty($_GET['CancelOrder']))
      : redirect_to("../index.php");
  endif;
  $order->CancelOrder();
  endif;
?>
<?php
  /* DisputeOrder */
  if (isset($_GET['DisputeOrder']))
      : if (intval($_GET['DisputeOrder']) == 0 || empty($_GET['DisputeOrder']))
      : redirect_to("../index.php");
  endif;
  $order->DisputeOrder();
  endif;
?>
<?php
  /* LoadOrders */
  if (isset($_GET['LoadOrders']))
      : if (intval($_GET['LoadOrders']) == 0 || empty($_GET['LoadOrders']))
      : redirect_to("../index.php");
  endif;
  $order->LoadOrders();
  endif;
?>
<?php
  /* LoadDisputeOrders */
  if (isset($_GET['LoadDisputeOrders']))
      : if (intval($_GET['LoadDisputeOrders']) == 0 || empty($_GET['LoadDisputeOrders']))
      : redirect_to("../index.php");
  endif;
  $order->LoadDisputeOrders(); 
  endif;
?>
<?php
  /* GetWithdrawlFee */
  if (isset($_GET['GetWithdrawlFee']))
      : if (intval($_GET['GetWithdrawlFee']) == 0 || empty($_GET['GetWithdrawlFee']))
      : redirect_to("../index.php");
  endif;
  $order->GetWithdrawlFee();
  endif;
?>
<?php
  /* GetWithdrawlHistory */
  if (isset($_GET['GetWithdrawlHistory']))
      : if (intval($_GET['GetWithdrawlHistory']) == 0 || empty($_GET['GetWithdrawlHistory']))
      : redirect_to("../index.php");
  endif;
  $order->GetWithdrawlHistory();
  endif;
?>
<?php
  /* moneyWithdrawlForm */
  if (isset($_POST['moneyWithdrawlForm']))
      : if (intval($_POST['moneyWithdrawlForm']) == 0 || empty($_POST['moneyWithdrawlForm']))
      : redirect_to("../index.php");
  endif;
  $order->moneyWithdrawlForm();
  endif;
?>
<?php
  /* moneyWithdrawlModal */
  if (isset($_GET['moneyWithdrawlModal']))
      : if (intval($_GET['moneyWithdrawlModal']) == 0 || empty($_GET['moneyWithdrawlModal']))
      : redirect_to("../index.php");
  endif;
  $order->moneyWithdrawlModal();
  endif;
?>
<?php
  /* CheckPayment */
  if (isset($_GET['CheckPayment']))
      : if (intval($_GET['CheckPayment']) == 0 || empty($_GET['CheckPayment']))
      : redirect_to("../index.php");
  endif;
  $order->CheckPayment();
  endif;
?>
<?php
  /* disputeReplyForm */
  if (isset($_POST['disputeReplyForm']))
      : if (intval($_POST['disputeReplyForm']) == 0 || empty($_POST['disputeReplyForm']))
      : redirect_to("../index.php");
  endif;
  $order->disputeReplyForm();
  endif;
?>
<?php
  /* disputeSmallerPriceForm */
  if (isset($_POST['disputeSmallerPriceForm']))
      : if (intval($_POST['disputeSmallerPriceForm']) == 0 || empty($_POST['disputeSmallerPriceForm']))
      : redirect_to("../index.php");
  endif;
  $order->disputeSmallerPriceForm();
  endif;
?>
<?php
  /* RejectSmallerRequest */
  if (isset($_GET['RejectSmallerRequest']))
      : if (intval($_GET['RejectSmallerRequest']) == 0 || empty($_GET['RejectSmallerRequest']))
      : redirect_to("../index.php");
  endif;
  $order->RejectSmallerRequest();
  endif;
?>
<?php
  /* AcceptSmallerRequest */
  if (isset($_GET['AcceptSmallerRequest']))
      : if (intval($_GET['AcceptSmallerRequest']) == 0 || empty($_GET['AcceptSmallerRequest']))
      : redirect_to("../index.php");
  endif;
  $order->AcceptSmallerRequest();
  endif;
?>
<?php
  /* OrderSentTable */
  if (isset($_GET['OrderSentTable']))
      : if (intval($_GET['OrderSentTable']) == 0 || empty($_GET['OrderSentTable']))
      : redirect_to("../index.php");
  endif;
  $order->OrderSentTable();
  endif;
?>
<?php
  /* SentOrderAgain */
  if (isset($_GET['SentOrderAgain']))
      : if (intval($_GET['SentOrderAgain']) == 0 || empty($_GET['SentOrderAgain']))
      : redirect_to("../index.php");
  endif;
  $order->SentOrderAgain();
  endif;
?>
<?php
  /* PayOrder */
  if (isset($_GET['PayOrder']))
      : if (intval($_GET['PayOrder']) == 0 || empty($_GET['PayOrder']))
      : redirect_to("../index.php");
  endif;
  $order->PayOrder();
  endif;
?>
