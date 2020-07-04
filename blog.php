<?php
require_once("include/db.php");
require_once("include/function.php");
require_once("include/session.php");
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
				<input class="form-control  mr-2" type="text" name="search" placeholder="Search here" required="">
				<button type="submit" name="find" class="btn btn-primary">Go</button>
			</div>
			</form>
		</ul>
	</div>
	</div>
</nav>
<!-- HEADER -->
<div class="container">
	<div class="row mt-4 mb-2">
		<div class="col-sm-8">
			<h1>The Complete CSS Begginer to Guru</h1>
			<h1 class="lead">The CSS Course by balaji bala</h1>
			<?php
			echo ErrorMsg();
			echo SuccessMsg();  
			?>
			<?php
			if(isset($_GET['find'])){
				$search=$_GET['search'];
				$sql="select * from posts where title like :searcH
				or category like :searcH
				or post like :searcH";
				$stmt=$con->prepare($sql);
				$stmt->bindValue(':searcH','%'.$search.'%');
				$stmt->execute();
				$result=$stmt->rowCount();
				if($result==0){
					$_SESSION["ErrorMsg"]="Not found";
					redirect("blog.php?page=1");
				}
			}elseif(isset($_GET['page'])){
				$page=$_GET['page'];
				if($page==0 || $page<1){
					$show=0;
				}else{
				$show=($page*5)-5;
			}
				$sql="select * from posts order by id desc limit $show,5";
				$stmt=$con->query($sql);
			}
			 elseif(isset($_GET["category"])){
				$Category=$_GET["category"];
				$sql="select * from posts where category='$Category' order by id desc";
				$stmt=$con->query($sql);
			}
			else{
				$sql="select * from posts order by id desc limit 0,3";
	            $stmt=$con->query($sql);
	        }
	    while($data=$stmt->fetch()){
		$postid=$data['id'];
		$Datetime=$data['datetime'];
		$Title=$data['title'];
		$category=$data['category'];
		$Author=$data['author'];
		$Image=$data['image'];
		$Post=$data['post'];
	?>
	<div class="card mb-3">
		<img src="upload/<?php echo htmlentities($Image); ?>" class="img-fluid card-img-top" style="max-height: 450px;">
		<div class="card-body">
			<h2 class="card-title"><?php echo htmlentities($Title); ?></h2>
			<small class="text-dark"><a href="myprofile.php?author=<?php echo htmlentities($Author);?>" target="_blank"><?php echo htmlentities($Author);?> </a>|| <?php echo htmlentities($Datetime);?> || <?php echo htmlentities($category);?>
			<span class="badge-dark py-1 px-1" style="float: right;">Comments 
				<?php echo approvecom($con,$postid);
				?></span></small>
			<hr>
			<p class="card-text">
				<?php 
			if(strlen($Post)>150){
				$Post=substr($Post,0,150).'...';
				echo htmlentities($Post);
			}?>
		</p>
			<a href="fullpost.php?id=<?php echo $postid; ?>" style="float: right";><span class="btn btn-primary py2 px2">Read More>></span></a>
		</div>
		</div>
		<br>
	<?php } ?>
	<!-- PAINGATION -->
	<nav>
	<ul class="pagination pagination-lg">
		<?php
		if(isset($page)){
			if($page>1){ ?>
				<li class="page-item"><a href="blog.php?page=<?php echo $page-1; ?>" class="page-link">&laquo;</a>
				</li>
			<?php } } ?>
		<?php
		$sql="select count(*) from posts";
		$stmt=$con->query($sql);
		$totpage=$stmt->fetch();
		$total=array_shift($totpage);
		$pagination=$total/5;
		$pagination=ceil($pagination);
		for($i=1;$i<=$pagination; $i++){
			if(isset($page)){
			if($i==$page){ ?>
			<li class="page-item active">
			<a href="blog.php?page=<?php echo $i;?>" class="page-link"><?php echo $i; ?></a>
			</li>
		<?php } else {
			?><li class="page-item">
			<a href="blog.php?page=<?php echo $i;?>" class="page-link"><?php echo $i; ?></a>
			</li>
		<?php } } } ?>
		<?php if(isset($page) && !empty($page) && strlen($page)<3){ 
			if($page+1<=$pagination){?>
			<li class="page-item">
				<a href="blog.php?page=<?php echo $page+1 ?>" class="page-link">
				&raquo;</a>
			</li>
		<?php } } ?>
			</ul>
	</nav>
	</div>
<!-- Side area -->
<div class="col-sm-4">
	<div class="card mt-4">
		<div class="card-body">
			<img src="imgs/tech.jpg" class="img-fluid d-block mb-3">
			<div class="">
			<p class="text-center">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vitae corporis officia possimus? Reiciendis ipsam quos nostrum delectus veritatis hic tenetur.</p>
		</div>
		</div>
	</div>
	<br>
	<div class="card mb-4">
		<div class="card-header bg-dark text-white">
			<h4 class="lead">Sign Up !</h4>
		</div>
		<div class="card-body">
			<button type="submit" class="mb-3 btn btn-success btn-block text-white text-center">Join the Forum</button>
			<button type="submit" class="mb-4 btn btn-danger btn-block text-white text-center">Login</button>
			<div class="input-group mb-3">
				<input type="email" class="form-control" name="email">
				<div class="input-group-append">
					<button type="submit" class="btn btn-sm btn-primary text-center text-white">Subscribe Now</button>
				</div>
		</div>
	</div>
	</div>
	<div class="card mb-4">
		<div class="card-header bg-dark text-light">
			<h2 class="lead">Categories</h2>
		</div>
		<div class="card-body">
			<?php
			$sql="select * from category order by id desc";
			$stmt=$con->query($sql);
			while($data=$stmt->fetch()){
				$Cid=$data['id'];
				$Ctit=$data['title'];
			?>
			<a href="blog.php?category=<?php echo $Ctit;?>" class="page-link"><span class="list-group main"><?php echo $Ctit; ?></span></a>
		<?php } ?>
		</div>
	</div>
	<div class="card">
		<div class="card-header bg-info text-light">
			<h2 class="lead">Recent Posts</h2>
		</div>
		<div class="card-body">
			<?php
			$sql="select * from posts order by id desc limit 0,5";
			$stmt=$con->query($sql);
			while($data=$stmt->fetch()){
				$Pid=$data["id"];
				$PDate=$data["datetime"];
				$Ptitle=$data["title"];
				$Pimage=$data["image"];
			?>
			<div class="media">
				<img src="upload/<?php echo $Pimage; ?>" class="d-block img-fluid align-self-start" 
				width="80" height="60">
				<div class="media-body ml-2">
					<a href="fullpost.php?id=<?php echo $Pid;?>" target="_blank"><h6 class="lead">
						<?php echo $Ptitle; ?>
					</h6></a>
					<p class="small text-dark"><?php echo $PDate; ?></p>
				</div>
			</div>
			<hr>
		<?php } ?>
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