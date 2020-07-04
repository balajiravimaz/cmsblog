<?php
require_once("include/db.php");
require_once("include/function.php");
require_once("include/session.php");
?>
<?php Login_conf(); 
$_SESSION["Track"]=$_SERVER["PHP_SELF"];
?>
<?php
if(isset($_POST['sub'])){
	$postitle=$_POST['postitle'];
	$catpost=$_POST['cat-post'];
	$image=$_FILES['image']['name'];
	$url="upload/".basename($_FILES['image']['name']);
	$postarea=$_POST['postarea'];
	$admin=$_SESSION["Admin"];
	date_default_timezone_set("Asia/Kolkata"); 
	$time=time();
	$date=strftime("%B-%d-%Y %H:%M:%S",$time);
	if(empty($postitle)){
		$_SESSION['ErrorMsg']="Title Cannot be empty";
		redirect('addpost.php');
	}elseif (strlen($postitle)<5) {
		$_SESSION['ErrorMsg']="Post title must be greater than 5";
		redirect('addpost.php');
	}elseif (strlen($postarea)>999) {
		$_SESSION['ErrorMsg']="Post Description must be less than 1000";
		redirect('addpost.php');
	}else{
		$sql="insert into posts (datetime,title,category,author,image,post)";
		$sql .="VALUES(:datetimE,:titlE,:categorY,:authoR,:imagE,:posT)";
		$stmt=$con->prepare($sql);
		$stmt->bindValue(':datetimE',$date);
		$stmt->bindValue(':titlE',$postitle);
		$stmt->bindValue(':categorY',$catpost);
		$stmt->bindValue(':authoR',$admin);
		$stmt->bindValue(':imagE',$image);
		$stmt->bindValue(':posT',$postarea);
		$exe=$stmt->execute();
		move_uploaded_file($_FILES['image']['tmp_name'], $url);
		if($exe){
				$_SESSION['SuccessMsg']="post Added Successfully";
		redirect('posts.php');
		}else{
				$_SESSION['ErrorMsg']="Something Went Wrong Try again";
		redirect('posts.php');
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
    <script type="text/javascript" src="js/ckeditor/ckeditor.js"></script>

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
				<h1><i class="fa fa-edit cl"></i>Add New Post</h1>
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
			<form action="addpost.php" method="post" enctype="multipart/form-data">
				<div class="card bg-secondary text-light mb-3">
					<!-- <div class="card-header">
						<h1>Add New Category</h1>
					</div> -->
					<div class="card-body bg-dark">
						<div class="form-group">
							<label for="post-title"><span class="tit">Post Title</span></label>
							<input type="text" name="postitle" id="title" placeholder="Enter the post title" class="form-control">
						</div>
						<div class="form-group">
							<label for="categorytitle"><span class="tit"> Select Category</span></label>
								<select class="form-control" id="categorytitle" name="cat-post">
									<?php
									$sql="select id,title from category";
									$stmt=$con->query($sql);
									while($data=$stmt->fetch()){
										$ID=$data['id'];
										$CatTit=$data['title'];
									?>
									<option><?php echo $CatTit?></option>
								<?php } ?>
								</select>
						</div>
						<div class="form-group">
							<div class="custom-file"> 
	      <input type="file" class="custom-file-input" id="imgselect" name="image">
							<label for="imgselect" class="custom-file-label">Select Image</label>
						</div>
						</div>
						<div class="form-group">
							<label for="post"><span class="tit">post</span></label>
							<textarea rows="30" cols="80" class="form-control" id="editor" name="postarea"></textarea>
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
    <script>
    	CKEDITOR.replace('editor');
    </script>
  </body>
</html>