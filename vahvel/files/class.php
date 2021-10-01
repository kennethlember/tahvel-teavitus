<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Logi sisse!</title>
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
		<div class="text-center">
			<img class="mb-4" src="assets/img/class.png" alt="" width="50%" height="auto">
		</div>
		<div class="text-center margin-top-50">
			<h4>Hei <strong><?php echo $user->name?></strong>, jätkamiseks vali oma klass.</h4>
		</div>
		<div class="margin-top-20">
			<?php $classes = $db->fetch_all("SELECT * FROM class"); ?>
			<?php foreach ($classes as $class): ?>
				<button class="btn btn-default btn-block btn-lg classbtn" data-id="<?php echo $class["id"];?>"><?php echo $class["name"];?></button>
			<?php endforeach; ?>
		</div>
    </div> 
<?php require "files/javascript.php"; ?>
	
  </body>
</html>
