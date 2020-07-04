<?php
require_once("include/db.php");
require_once("include/function.php");
require_once("include/session.php");
?>
<?php Login_conf(); 
$_SESSION["Track"]=$_SERVER["PHP_SELF"];
?>
<?php
$Adminid=$_SESSION["Id"];
$sql="select * from admins where id='$Adminid'";
$stmt=$con->query($sql);
while($data=$stmt->fetch()){
	$Exname=$data['aname'];
	$Exbio=$data['bio'];
	$Ehead=$data['headline'];
	$Euname=$data['username'];
	$Eimage=$data['a_image'];
}
if(isset($_POST['sub'])){
	$anem=$_POST['yname'];
	$headline=$_POST['head'];
	$bio=$_POST['bio'];
	$Image=$_FILES['image']['name'];
	$url="imgs/".basename($_FILES['image']['name']);
	if (empty($anem) &&  empty($bio)) {
		$_SESSION['ErrorMsg']="all the fiels must be filled out";
		redirect('profile.php');
	}
	 else{
		if(!empty($_FILES['image']['name'])){
			$sql="update admins 
			set aname='$anem', headline='$headline', bio='$bio', a_image='$Image' where id='$Adminid'";
		}else{
		$sql="update admins
		 set aname='$anem', headline='$headline', bio='$bio' where id='$Adminid'";
	}
		$exe=$con->query($sql);
		move_uploaded_file($_FILES['image']['tmp_name'], $url);
		if($exe){  
				$_SESSION['SuccessMsg']="Admin Updated Successfully";
		redirect('profile.php');
		}else{
				$_SESSION['ErrorMsg']="Something Went Wrong Try again";
		redirect('profile.php');
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
		<ul class="navbar-nav mr-auto">
			<li class="nav-item">
				<a class="nav-link" href="profile.php"><i class="fa fa-user text-success"></i> My Profile</a></li>
				<li class="nav-item">
				<a class="nav-link" href="dash.php">Dashboard</a></li>
				<li class="nav-item">
				<a class="nav-link" href="#">Posts</a></li>
				<li class="nav-item">
				<a class="nav-link" href="#">Categories</a></li>
				<li class="nav-item">
				<a class="nav-link" href="#">Manage Admin</a></li>
				<li class="nav-item">
				<a class="nav-link" href="#">Comments</a></li>
				<li class="nav-item">
				<a class="nav-link" href="#">Live Blog</a></li>
		</ul>
		<ul class="navbar-nav ml-auto">
			<li clas="nav-item">
		    <a class="nav-link text-danger" href="logout.php"><i class="fa fa-user-times"></i> Logout</a></li>
		</ul>
	</div>
	</div>
</nav>
<!-- HEADER -->
<header class="bg-dark text-white py-3">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1><i class="fa fa-edit cl"></i><?php echo $Euname; ?></h1>
				<span class="small"><?php echo $Ehead; ?></span>
			</div>
		</div>
	</div>
</header> 
<!-- HEADER -->
<!-- MAIN -->
<section class="container py-2 mb-4">
	<div class="row">
		<div class="col-md-3">
			<div class="card">
				<div class="card-header bg-dark text-light">
					<h4><?php echo $Exname; ?></h4>
				</div>
				<div class="card-body">
					<img src="imgs/<?php echo $Eimage; ?>" class="d-block img-fluid">
					<div class="">
						<p><?php echo $Exbio; ?></p>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-9">
			<?php
			echo ErrorMsg();
			echo SuccessMsg();
			?>
			<form action="" method="post" enctype="multipart/form-data">
				<div class="card bg-secondary text-light mb-3">
					<!-- <div class="card-header">
						<h1>Add New Category</h1>
					</div> -->
					<div class="card-header bg-secondary">
						<h4>Edit Profile</h4>
					</div>
					<div class="card-body bg-dark">
						<div class="form-group">
							<input type="text" name="yname" id="yname" placeholder="Enter Name" class="form-control">
						</div>
						<div class="form-group">
							<input type="text" name="head" placeholder="Enter the bio" class="form-control">
							<span class="small text-danger">Add your Profession</span>
						</div>
						<div class="form-group">
							<textarea cols="15" rows="10" class="form-control" name="bio"></textarea>
						</div>
						<div class="form-group">
							<div class="custom-file"> 
	      <input type="file" class="custom-file-input" id="imgselect" name="image">
							<label for="imgselect" class="custom-file-label">Select Image</label>
						</div>
						</div>
						<div class="row">
							<div class="col-md-6 mb-2">
								<a href="dashboard.php" class="btn btn-warning btn-block"><i class="fa fa-left-arrow"></i>Back to Dashboard</a>
							</div>
							<div class="col-md-6 mb-2">
								<button type="submit" name="sub" class="btn btn-success btn-block"><i class="fa fa-check"></i>Publish</button>
						</div>
					</div>
				</div>
			</form>

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