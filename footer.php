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