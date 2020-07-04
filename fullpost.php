<?php
require_once("include/db.php");
require_once("include/function.php");
require_once("include/session.php");
$posid=$_GET['id'];
?>
<?php
if(isset($_POST['submit'])){
	$cname=$_POST['cname'];;
	$cemail=$_POST['cemail'];
	$ctext=$_POST['ctext'];
	$admin="balaji";
	date_default_timezone_set("Asia/Kolkata");
	$time=time();
	$date=strftime("%B-%d-%Y %H:%M:%S",$time);
	if(empty($cname) || empty($cemail) || empty($ctext)){
		$_SESSION['ErrorMsg']="All the filed must be filled";
		echo $posid;
		redirect("fullpost.php?id={$posid}");
	}elseif (strlen($ctext)>499) {
		$_SESSION['ErrorMsg']="Comments  must be less than 499 Characters";
		redirect("fullpost.php?id={$posid}");
	}
	// Query to insert Comments
	else{
		$sql="insert into comments (datetime,name,email,comment,approve,status,post_id)";
		$sql .="VALUES(:datetimE,:namE,:emaiL,:commenT,'pending','OFF',:postiD)";
		$stmt=$con->prepare($sql);
		$stmt->bindValue(':datetimE',$date);
		$stmt->bindValue(':namE',$cname);
		$stmt->bindValue(':emaiL',$cemail);
		$stmt->bindValue(':commenT',$ctext);
		$stmt->bindValue(':postiD',$posid);
		$exe=$stmt->execute();
		if($exe){
				$_SESSION['SuccessMsg']="Comment Added Successfully";
		redirect("fullpost.php?id={$posid}");
		}else{
				$_SESSION['ErrorMsg']="Something Went Wrong Try again";
		redirect("fullpost.php?id={$posid}");
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
			echo SuccessMsg();
			echo ErrorMsg();
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
			}else{					
				if(!isset($posid)){
					// $_SESSION['ErrorMsg']="";
					redirect("blog.php");
				}
				$sql="select * from posts where id='$posid'";
	            $stmt=$con->query($sql);
	            $result=$stmt->rowCount();
	            if($result!=1){
	            	$_SESSION["ErrorMsg"]="Bad Request";
	            	redirect("blog.php?page=1");

	            }
			}
	while($data=$stmt->fetch()){
		$id=$data['id'];
		$datetime=$data['datetime'];
		$title=$data['title'];
		$category=$data['category'];
		$author=$data['author'];
		$image=$data['image'];
		$post=$data['post'];
	?>
	<div class="card mb-3">
		<img src="upload/<?php echo htmlentities($image); ?>" class="img-fluid card-img-top" style="max-height: 450px;">
		<div class="card-body">
			<h2 class="card-title"><?php echo htmlentities($title); ?></h2>
			<small class="text-muted"><?php echo htmlentities($datetime);?><span class="badge-dark" style="float: right;">Comments 20</span></small>
			<hr>
			<p class="card-text">
				<?php echo nl2br($post);?>
		</p>
		</div>
		</div>
	<?php } ?>
	<!-- Comments -->
	<span class="tit bottom mb-8">Comments</span>
	<?php
	$sql="select * from comments where post_id='$posid' and status='ON'";
	$stmt=$con->query($sql);
	while($data=$stmt->fetch()){
		$datetime=$data['datetime'];
		$name=$data['name'];
		$comment=$data['comment'];
	?>
	<div class="media combg">
		<img src="imgs/comment.png" class="d-block img-fluid" width="100" height="70">
		<div class="media-body ml-3">
			<h6 class="lead"><b><?php echo $name; ?></b></h6>
			<p class="small"><?php echo $datetime ?></p>
			<p class="siz"><?php echo $comment ?></p>
		</div>
	</div>
	<hr>
	<?php } ?>
	<form class="" action="fullpost.php?id=<?php echo $posid;?>" method="post">
		<div class="card mb-3">
			<div class="card-header">
				<h5 class="tit">Share Your Thoughts</h5>
			</div>
			<div class="card-body">
				<div class="form-group">
					<div class="input-group mb-3">
						<div class="input-group-prepand">
							<span class="input-group-text form-control"><i class="fa fa-user"></i></span>
						</div>
						<input type="text" class="form-control" name="cname" placeholder="Enter Your Name">
					</div>
						<div class="input-group mb-3">
						<div class="input-group-prepand">
							<span class="input-group-text form-control"><i class="fa fa-envelope"></i></span>
						</div>
						<input type="email" class="form-control" name="cemail" placeholder="Enter Your Email">
					</div>
					<div class="input-group">
						<textarea class="form-control" cols="10" rows="15" name="ctext"></textarea>
					</div>
					<div class="input-group mt-2">
						<button type="submit" name="submit" class="btn btn-primary">Submit</button>
					</div>
				</div>
			</div>
		</div>
	</form>
	</div>

<?php 
require_once("footer.php");
?>

<!-- HEADER -->
<!-- MAIN -->

<!-- MAIN - END -->
<!-- FOOTER -->
