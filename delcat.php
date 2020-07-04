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
	$name=$_GET['title'];
	$sql="delete from category where id='$comid'";
	$stmt=$con->query($sql);
	if($stmt){
		$_SESSION["SuccessMsg"]="Category {$name} Deleted Successfully";
		redirect("category.php");
	}
	else{
		$_SESSION["ErrorMsg"]="something Went wrong";
		redirect("category.php");
	}
}