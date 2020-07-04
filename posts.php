<?php
require_once("include/db.php");
require_once("include/function.php");
require_once("include/session.php");
?>
<?php 
$_SESSION["Track"]=$_SERVER["PHP_SELF"];
Login_conf(); 
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
				<h1><i class="fa fa-blog cl"></i>Blog Post</h1>
			</div>
			<div class="col-lg-3 mb-2">
				<a href="addpost.php" class="btn btn-block btn-primary"><i class="fa fa-edit"></i> Add New Post
				</a>
			</div>
			<div class="col-lg-3 mb-2">
				<a href="category.php" class="btn btn-block btn-info"><i class="fa fa-plus"></i> Add New Category
				</a>
			</div>
			<div class="col-lg-3 mb-2">
				<a href="#" class="btn btn-block btn-warning"><i class="fa fa-user"></i> Add New Admin
				</a>
			</div>
			<div class="col-lg-3 mb-2">
				<a href="#" class="btn btn-block btn-success"><i class="fa fa-check"></i> Approve Comments
				</a>
			</div>
		</div>
	</div>
</header> 
<!-- HEADER -->
<!-- MAIN -->
<section class="container py-2 mb-4">
	<div class="row">
		<div class="col-lg-12">
			<?php
			echo ErrorMsg();
			echo SuccessMsg();
			?>

			<table class="table table-striped table-hover">
				<thead class="thead-dark">
				<tr>
					<th>#</th>
					<th>Title</th>
					<th>Category</th>
					<th>Date&time</th>
					<th>Author</th>
					<th>Image</th>
					<th>Comments</th>
					<th>Action</th>
					<th>Live Preview</th>
				</tr>
			</thead>
				<?php
				$sql="select * from posts order by id desc";
				$stmt=$con->query($sql);
				$sr=0;
				while($data=$stmt->fetch()){
					$posid=$data['id'];
					$title=$data['title'];
					$category=$data['category'];
					$date=$data['datetime']	;
					$author=$data['author'];
					$image=$data['image'];
					$sr++;
				?>
				<tbody>
				<tr>
					<td><?php echo $sr ?></td>
					<td><?php
					if(strlen($title)>20){ $title=substr($title,0,18).'...';} 
					 echo $title ?>		
						</td>
					<td><?php
					if(strlen($category)>8){ $category=substr($category,0,8).'...';} 
						echo $category ?>
						</td>
					<td><?php
					if(strlen($date)>11){ $date=substr($date,0,11).'...';} 
						echo $date ?></td>
					<td><?php echo $author ?></td>
					<td><img class="post-img" src="upload/<?php echo $image ?>"></td>
					<td>
					<?php
					$apptotal=approvecom($con,$posid);
					if($apptotal>0){
						?>
						<span class="badge badge-success">
							<?php echo $apptotal; ?>
							</span>
						<?php } ?>
						<?php 
						$unaptotal=unapprovecom($con,$posid);
						if($unaptotal>0){
						?>
						<span class="badge badge-danger">
							<?php echo $unaptotal; ?>
							</span>
						<?php } ?>
					</td>
					<td><a href="editpost.php?id=<?php echo $posid ?>"><span class="btn btn-warning">Edit</span></a>
						<a href="deletepost.php?id=<?php echo $posid ?>" class="btn btn-danger">Delete</a>
					</td>
					<td><a href="fullpost.php?id=<?php echo $posid; ?>" target="_blank"><span class="btn btn-primary"><i class="fa fa-eye"></i> Live Preview</span></a></td>
				</tr>
			</tbody>
			<?php } ?>
			</table>
		</div>
		<!-- <nav class="offset-sm-4">
			<ul class="pagination pagination-lg">
				<?php

				?>
				<li class="page-item"><a href="#" class="page-link">1</a></li>
				<li class="page-item"><a href="#" class="page-link">1</a></li>
			</ul> -->
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