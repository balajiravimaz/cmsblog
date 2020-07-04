hp
require_once("include/db.php");
require_once("include/function.php");
require_once("include/session.php");
?>
<?php
Login_conf();
$_SESSION["Track"] = $_SERVER["PHP_SELF"];
?>
<?php
if (isset($_GET["id"])) {
	$comid = $_GET["id"];
	$sql = "delete from admins where id='$comid'";
	$stmt = $con->query($sql);
	if ($stmt) {
		$_SESSION["SuccessMsg"] = "Admin Deleted Successfully";
		redirect("admin.php");
	} else {
		$_SESSION["ErrorMsg"] = "something Went wrong";
		redirect("admin.php");
	}
}
