<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Vahvel2 - Registeeri omale kasutaja</title>
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
				<h2 class="form-signin-heading margin-top-50">Registeeri</h2>
				<p>Hei, kui sa juba siin oled siis loo omale kasutaja!</p>
				</div>
				<div class="well well-sm well-light  margin-top-20">
				<form id="RegisterForm" action="javascript:void(0)" method="POST">
					<input type="hidden" name="RegisterForm" value="1">
					<div class="row">
						<div class="col-xs-6">
							<div class="form-group">
								<input type="text" name="fname" class="form-control input-lg" placeholder="Eesnimi" required autofocus>
							</div>
						</div>
						<div class="col-xs-6">
							<div class="form-group">
								<input type="text" name="lname" class="form-control input-lg" placeholder="Perenimi" required autofocus>
							</div>
						</div>
						<div class="col-xs-12">
							<div class="form-group">
								<input type="email" name="email" class="form-control input-lg" placeholder="E-mail" required autofocus>
							</div>
						</div>
						<div class="col-xs-12">
							<div class="form-group">
								<input type="password" name="password" class="form-control input-lg" placeholder="Salasõna" required autofocus>
							</div>
						</div>
					</div>
					<div class="form-group">
						<button class="btn btn-lg btn-primary btn-block" type="submit">Registeeri kasutaja</button>
					</div>
				</form>
				</div>
				<div class="text-center">
					<a href="login.php">Sul on kasutaja juba olemas?</a>
				</div>
			</div>
		</div>
    </div> 
<?php require "files/javascript.php"; ?>
	
  </body>
</html>
