<?php
require_once("include/db.php");
require_once("include/function.php");
require_once("include/session.php");
?>
<?php
if(isset($_SESSION["Id"])){
	redirect("dashboard.php");
}
?>
<?php
if(isset($_POST['submit'])){
	$username=$_POST['username'];
	$password=$_POST['password'];
	if(empty($username) || empty($password)){
		$_SESSION[ErrorMsg]="All the Fields Must be Filled";
		redirect("login.php");
	}else{
		$found=login($con,$username,$password);
		if($found){
		$_SESSION["Id"]=$found['id'];
		$_SESSION["Name"]=$found['name'];
		$_SESSION["Admin"]=$found['username'];
		$_SESSION["SuccessMsg"]="Welcome ".$_SESSION["Admin"];
		if(isset($_SESSION["Track"])){
			redirect($_SESSION["Track"]);
		}else{
		redirect("dashboard.php");
	}
	}else{
		$_SESSION["ErrorMsg"]="Incorrect Username & Password";
		redirect("login.php");
	}
}
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="google" content="notranslate">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>CSSGURU | HOME</title>
  </head>
  <body>
<!-- NAVBAR -->
<div class="bg"></div>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
	<div class="container">
		<a href="#" class="navbar-brand">CSSGURU</a>
		<button class="navbar-toggler" data-toggle="collapse" data-target="#navcol">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navcol">
		
	</div>
	</div>
</nav>
<!-- HEADER -->
<header class="bg-dark text-white">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
		
			</div>
		</div>
	</div>
</header> 
<!-- HEADER -->
<!-- MAIN -->
<section class="container py-2 mb-4">
	<div class="row">
		<div class="offset-sm-3 col-sm-6" style="min-height: 400px;">
			<br><br>
			<?php
			echo ErrorMsg();
			echo SuccessMsg();
			?>
			<div class="card bg-secondary text-light">
				<div class="card-header">
					<h4>Welcome back!</h4>
					</div>
					<div class="card-body bg-dark">
				<form class="" action="login.php" method="post">
					<div class="form-group">
						<label for="uname"><span class="tit">Username</span></label>
						<div class="input-group mb-3">
							<div class="input-group-prepand">
								<span class="input-group-text rounded-0 border-primary text-white bg-info d-block"><i class="fa fa-user"></i></span>
							</div>
							<input type="text" name="username" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label for="pass"><span class="tit">Password</span></label>
						<div class="input-group mb-3">
							<div class="input-group-prepand">
								<span class="input-group-text rounded-0 border-primary text-white bg-info d-block"><i class="fa fa-lock"></i></span>
							</div>
							<input type="password" name="password" class="form-control">
						</div>
					</div>
					<input type="submit" name="submit" class="btn btn-info form-control" value="Login">
				</form>

			</div>
		</div>
	</div>
	
</section>
<!-- MAIN - END -->
<!-- FOOTER -->
<footer class="bg-dark text-white">
	<div class="container">
		<div class="row">
			<div class="col">
			<p class="lead text-center">Theme by CSSGURU | &copy; <span id="year"></span> All Rights Reserved</p>
			<p class="text-center small">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo, placeat iure deleniti! Eum, dolorem architecto.</p>
		</div>
	</div>
	</div>
</footer>
<div class="bg"></div>




    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script>
    	$('#year').text(new Date().getFullYear());
    </script>
  </body>
</html>