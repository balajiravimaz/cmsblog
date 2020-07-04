<?php
require_once("include/db.php");
require_once("include/function.php");
require_once("include/session.php");
?>
<?php
$posname=$_GET['author'];
$sql="select username,aname,headline,bio,a_image from admins where username=:usernamE";
$stmt=$con->prepare($sql);
$stmt->bindValue(":usernamE",$posname);
$stmt->execute();
$result=$stmt->rowCount();
if($result==1){
	while($data=$stmt->fetch()){
		$Ename=$data['aname'];
		$Ehead=$data['headline'];
		$Ebio=$data['bio'];
		$Eimage=$data['a_image'];
	}
}else{
	$_SERVER["ErrorMsg"]="Bad Request";
	redirect("blog.php?page=1");
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

    <title>CSSGURU | POSTS</title>
  </head>
  <style>

.main{
	color: #555;
	font-size: 1.2rem;
	display: block;
}
  </style>
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
		<ul class="navbar-nav mr-auto">
				<li class="nav-item">
				<a class="nav-link" href="#">Home</a></li>
				<li class="nav-item">
				<a class="nav-link" href="#">About Us</a></li>
				<li class="nav-item">
				<a class="nav-link" href="#">Blog</a></li>
				<li class="nav-item">
				<a class="nav-link" href="#">Contact Us</a></li>
				<li class="nav-item">
				<a class="nav-link" href="#">Features</a></li>
		</ul>
		<ul class="navbar-nav ml-auto">
			<form class="form-inline" action="blog.php" method="get">
				<div class="form-group">
				<input class="form-control  mr-2" type="text" name="search" placeholder="Search here">
				<button type="submit" name="find" class="btn btn-primary">Go</button>
			</div>
			</form>
		</ul>
	</div>
	</div>
</nav>
<!-- HEADER -->
<header class="bg-dark text-white py-3">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2><i class="fa fa-user text-success"></i> <?php echo $Ename; ?></h2>
				<span class="small"><?php echo $Ehead; ?></span>
			</div>
		</div>
	</div>
</header>
<!--  -->
<div class="container">
	<div class="row mt-4 mb-2">
		<div class="col-md-3">
			<img src="imgs/<?php echo $Eimage; ?>" class="d-block img-fluid rounded-circle">
		</div>
		<div class="col-md-9 mt-4" style="min-height: 450px";>
			<div class="card">
				<div class="card-body">
					<p><?php echo $Ebio; ?></p>
				</div>

			</div>
		</div>
	</div>
</div>
<!-- HEADER -->
<!-- MAIN -->

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