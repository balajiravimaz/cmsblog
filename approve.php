<?php
require_once("include/db.php");
require_once("include/function.php");
require_once("include/session.php");
?>
<?php
Login_conf(); 
$_SESSION["Track"]=$_SERVER["PHP_SELF"];
?>
<?php
if(isset($_GET["id"])){
	$comid=$_GET["id"];
	$admin=$_SESSION["Admin"];
	$sql="update comments set status='ON', approve='$admin' where id='$comid'";
	$stmt=$con->query($sql);
	if($stmt){
		$_SESSION["SuccessMsg"]="Comments Approved";
		redirect("comment.php");
	}
	else{
		$_SESSION["ErrorMsg"]="something Went wrong";
		redirect("comment.php");
	}
}