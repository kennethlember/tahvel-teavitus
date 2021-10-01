<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Vahvel2 - Logi sisse oma kasutajale</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="container">
		<div class="row">
			<div class="col-lg-6 col-lg-offset-3">
				<div class="text-center">
					<img src="assets/img/logo1.png" alt="" width="100%" height="auto">
				</div>
				<div class="text-center margin-top-50">
				<h2 class="form-signin-heading margin-top-50">Sisselogimine</h2>
				<p>Hei, kui sa juba siin oled siis logi sisse ka!</p>
				</div>
				<div class="well well-sm well-light  margin-top-20">
				<form id="LoginForm" action="javascript:void(0)" method="POST">
					<input type="hidden" name="LoginForm" value="1">
					<div class="form-group">
						<label for="inputEmail" class="sr-only">Sinu e-mail</label>
						<input type="email" name="email" id="inputEmail" class="form-control input-lg" placeholder="Sinu e-mail" required autofocus>
					</div>
					<div class="form-group">
						<label for="inputPassword" class="sr-only">Sinu parool</label>
						<input type="password" name="password" id="inputPassword" class="form-control input-lg" placeholder="Sinu parool" required>
					</div>
					<div class="form-group">
						<button class="btn btn-lg btn-primary btn-block" type="submit">Logi sisse</button>
					</div>
				</form>
				</div>
				<div class="text-center">
					<a href="register.php">Sul pole kasutajat?</a>
				</div>
			</div>
		</div>
    </div> <!-- /container -->
<?php require "files/javascript.php"; ?>
  </body>
</html>
