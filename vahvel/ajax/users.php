<?php
/**	User **/
  define("_VALID_PHP", true);
  require_once("../init.php");
?>
<?php
  /* LoginForm */
  if (isset($_POST['LoginForm']))
      : if (intval($_POST['LoginForm']) == 0 || empty($_POST['LoginForm']))
      : redirect_to("../index.php");
  endif;
  $email = sanitize($_POST["email"]);
  $password = sanitize($_POST["password"]); 
  $user->LoginForm($email,$password);
  endif;
?>
<?php
  /* RegisterForm */
  if (isset($_POST['RegisterForm']))
      : if (intval($_POST['RegisterForm']) == 0 || empty($_POST['RegisterForm']))
      : redirect_to("../index.php");
  endif;
  $user->Register();
  endif;
?>
<?php
  /* ChooseClass */
  if (isset($_GET['ChooseClass']))
      : if (intval($_GET['ChooseClass']) == 0 || empty($_GET['ChooseClass']))
      : redirect_to("../index.php");
  endif;
  $user->ChooseClass();
  endif;
?>
<?php
  /* getSubjects */
  if (isset($_GET['getSubjects']))
      : if (intval($_GET['getSubjects']) == 0 || empty($_GET['getSubjects']))
      : redirect_to("../index.php");
  endif;
  $user->getSubjects();
  endif;
?>
<?php
  /* RegisterFirebaseToken */
  if (isset($_POST['RegisterFirebaseToken']))
      : if (intval($_POST['RegisterFirebaseToken']) == 0 || empty($_POST['RegisterFirebaseToken']))
      : redirect_to("../index.php");
  endif;
  $user->RegisterFirebaseToken();
  endif;
?>

<?php /**** ****/ ?>

<?php
  /* VerifyForm */
  if (isset($_POST['VerifyForm']))
      : if (intval($_POST['VerifyForm']) == 0 || empty($_POST['VerifyForm']))
      : redirect_to("../index.php");
  endif;
  $user->Verify();
  endif;
?>
<?php
  /* ResendVerifyCode */
  if (isset($_GET['ResendVerifyCode']))
      : if (intval($_GET['ResendVerifyCode']) == 0 || empty($_GET['ResendVerifyCode']))
      : redirect_to("../index.php");
  endif;
  $data = array(
	"name" => $user->name,
	"code" => $user->code,
	"email" => $user->email
  );
  $user->SendVerifyCode($data);
  
  $result["success"] = "1";
  $result["msg"] = "Code sent again your e-mail";
  echo json_encode($result,true);
  endif;
?>
<?php
  /* UpdateProfileForm */
  if (isset($_POST['UpdateProfileForm']))
      : if (intval($_POST['UpdateProfileForm']) == 0 || empty($_POST['UpdateProfileForm']))
      : redirect_to("../index.php");
  endif;
  $user->UpdateProfileForm();
  endif;
?>
<?php
  /* ChangePasswordForm */
  if (isset($_POST['ChangePasswordForm']))
      : if (intval($_POST['ChangePasswordForm']) == 0 || empty($_POST['ChangePasswordForm']))
      : redirect_to("../index.php");
  endif;
  $user->ChangePasswordForm();
  endif;
?>
<?php
  /* ChangeAvatarForm */
  if (isset($_POST['ChangeAvatarForm']))
      : if (intval($_POST['ChangeAvatarForm']) == 0 || empty($_POST['ChangeAvatarForm']))
      : redirect_to("../index.php");
  endif;
  $user->ChangeAvatarForm();
  endif;
?>
<?php
  /* bankAccountAddForm */
  if (isset($_POST['bankAccountAddForm']))
      : if (intval($_POST['bankAccountAddForm']) == 0 || empty($_POST['bankAccountAddForm']))
      : redirect_to("../index.php");
  endif;
  $user->bankAccountAddForm();
  endif;
?>
<?php
  /* ChangeBankForm */
  if (isset($_POST['ChangeBankForm']))
      : if (intval($_POST['ChangeBankForm']) == 0 || empty($_POST['ChangeBankForm']))
      : redirect_to("../index.php");
  endif;
  $user->bankAccountAddForm();
  endif;
?>
<?php
  /* ContactSupportForm */
  if (isset($_POST['ContactSupportForm']))
      : if (intval($_POST['ContactSupportForm']) == 0 || empty($_POST['ContactSupportForm']))
      : redirect_to("../index.php");
  endif;
  $user->ContactSupportForm();
  endif;
?>
<?php
  /* CheckIfUserFirstTime */
  if (isset($_GET['CheckIfUserFirstTime']))
      : if (intval($_GET['CheckIfUserFirstTime']) == 0 || empty($_GET['CheckIfUserFirstTime']))
      : redirect_to("../index.php");
  endif;
  $user->CheckIfUserFirstTime();
  endif;
?>
<?php
  /* ForgotpwdForm */
  if (isset($_POST['ForgotpwdForm']))
      : if (intval($_POST['ForgotpwdForm']) == 0 || empty($_POST['ForgotpwdForm']))
      : redirect_to("../index.php");
  endif;
  $user->ForgotpwdForm();
  endif;
?>
<?php
  /* SetUserIDtoFirebaseToken */
  if (isset($_POST['SetUserIDtoFirebaseToken']))
      : if (intval($_POST['SetUserIDtoFirebaseToken']) == 0 || empty($_POST['SetUserIDtoFirebaseToken']))
      : redirect_to("../index.php");
  endif;
  $user->SetUserIDtoFirebaseToken();
  endif;
?>
<?php
  /* CheckIfUserLoggedIN */
  if (isset($_GET['CheckIfUserLoggedIN']))
      : if (intval($_GET['CheckIfUserLoggedIN']) == 0 || empty($_GET['CheckIfUserLoggedIN']))
      : redirect_to("../index.php");
  endif;
  $user->CheckIfUserLoggedIN();
  endif;
?>
