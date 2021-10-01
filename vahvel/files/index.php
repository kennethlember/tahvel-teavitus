<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Vahvel - Tunniplaan sinu taskus!</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="assets/css/style.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php"><img src="assets/img/logo3.png" width="80"></a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav navbar-right">
			<?php if ($user->admin) { ?>
			<li class="active"><a href="admin.php">Admin</a></li>
			<?php } ?>
            <li><a href="logout.php">Logi välja</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
    <div class="container margin-top-20">
		<div class="row">
			<div class="col-xs-12">
			<div class="well well-sm">
				<h4>Hei <strong><?php echo $user->name;?></strong>!</h4>
				<p>Siin näed oma tänaseid tunde ja ka järgnevate päevade tunde. Kui peaks tundides mingi muudatus tekkima, siis teavitame sind koheselt nii e-maili kui notificationi kaudu!</p>
			</div>

				<ul class="nav nav-tabs showTab" role="tablist">
					<li role="presentation" class=""><a href="#today" aria-controls="today" role="tab" data-toggle="tab">Tänased tunnid</a></li>
					<li role="presentation"><a href="#other" aria-controls="other" role="tab" data-toggle="tab">Järgnevad tunnid</a></li>
				</ul>			
				<div class="tab-content">
					<div role="tabpanel" class="tab-pane fade" id="today"></div>
					<div role="tabpanel" class="tab-pane fade" id="other">...</div>
				</div>


				
			</div>
		</div>
    </div> 
<?php require "files/javascript.php"; ?>
	<script>
		$(document).ready(function() {
			 $('.showTab a[href="#today"]').tab('show');
		});
	</script>
  </body>
</html>
