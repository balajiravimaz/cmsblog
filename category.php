<?php
require_once("include/db.php");
require_once("include/function.php");
require_once("include/session.php");
?>
<?php Login_conf(); 
$_SESSION["Track"]=$_SERVER["PHP_SELF"];
?>
<?php
if(isset($_POST["sub"])){
	$field=$_POST["Title"];
	$admin=$_SESSION["Admin"];
	date_default_timezone_set("Asia/Kolkata");
	$time=time();
	$date=strftime("%B-%d-%Y %H:%M:%S",$time);
	if(empty($field)){
		$_SESSION['ErrorMsg']="All the filed must be filled";
		redirect('category.php');
	}elseif (strlen($field)<3) {
		$_SESSION['ErrorMsg']="Category title must be greater than 3";
		redirect('category.php');
	}elseif (strlen($field)>49) {
		$_SESSION['ErrorMsg']="Category title must be less than 49";
		redirect('category.php');
	}else{
		$sql="insert into category (title,author,datetime)";
		$sql .="VALUES(:titlE,:authoR,:datetimE)";
		$stmt=$con->prepare($sql);
		$stmt->bindValue(':titlE',$field);
		$stmt->bindValue(':authoR',$admin);
		$stmt->bindValue(':datetimE',$date);
		$exe=$stmt->execute();
		if($exe){
				$_SESSION['SuccessMsg']="Category Added Successfully";
		redirect('category.php');
		}else{
				$_SESSION['ErrorMsg']="Something Went Wrong Try again";
		redirect('category.php');
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
				<h1><i class="fa fa-edit cl"></i> Manage Categories</h1>
			</div>
		</div>
	</div>
</header> 
<!-- HEADER -->
<!-- MAIN -->
<section class="container py-2 mb-4">
	<div class="row">
		<div class="offset-lg-1 col-md-10 min">
			<?php
			echo ErrorMsg();
			echo SuccessMsg();
			?>
			<form action="category.php" method="post">
				<div class="card bg-secondary text-light mb-3">
					<div class="card-header">
						<h1>Add New Category</h1>
					</div>
					<div class="card-body bg-dark">
						<div class="form-group">
							<label for="title"><span class="tit">Category Title</span></label>
							<input type="text" name="Title" id="title" placeholder="Enter the Category" class="form-control">
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
		<h5>Existing Category</h5>
			<table class="table table-striped table-hover">
				<thead class="thead-dark">
					<tr>
						<th>S.No</th>
						<th>Date&Time</th>
						<th>Category Name</th>
						<th>Author</th>
						<th>Action</th>
					</tr>
				</thead>
			<?php 
			$sql="select * from category order by id desc";
			$stmt=$con->query($sql);
			$stmt->execute();
			$sr=0;
			while($data=$stmt->fetch()){
				$Cid=$data['id'];
				$Cdat=$data['datetime'];
				$Ctitle=$data['title'];
				$Cauth=$data['author'];
				$sr++;
			?>
			<tbody>
				<tr>
					<td><?php echo $sr; ?></td>
					<td><?php echo $Cdat; ?></td>
					<td><?php echo $Ctitle; ?></td>
					<td><?php echo $Cauth; ?></td>
					<td><a href="delcat.php?id=<?php echo $Cid; ?>" class="btn btn-danger">Delete</a></td>
				</tr>
			</tbody>
		<?php } ?>
		</table>
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