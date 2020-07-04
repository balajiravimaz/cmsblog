<?php
require_once("db.php");
?>
<?php
function redirect($url){
	header("Location:".$url);
	exit;
}

function checkname($con,$uname){
	$sql="select username from admins where username=:unamE";
	$stmt=$con->prepare($sql);
	$stmt->bindValue(':unamE',$uname);
	$stmt->execute();
	$result=$stmt->rowCount();
	if($result==1){
		return true;
	}
	else{
		return false;
	}
}

function login($con,$username,$password){
	$sql="select * from admins where username=:usernamE AND password=:passworD limit 1";
	$stmt=$con->prepare($sql);
	$stmt->bindValue(':usernamE',$username);
	$stmt->bindValue(':passworD',$password);
	$stmt->execute();
	$result=$stmt->rowCount();
	if($result==1){
		return $found=$stmt->fetch();
	}else{
		return  null;
	}
}

function Login_conf(){
	if(isset($_SESSION['Id'])){
		return true;
	}else{
		$_SESSION["ErrorMsg"]="Login Required";
		redirect("login.php");
	}
}
function totalpost($con){
$sql="select count(*) from posts";
 $stmt=$con->query($sql);
 	$totalrows=$stmt->fetch();
	$total=array_shift($totalrows);
	echo $total;
}
function totalcategory($con){
$sql="select count(*) from category";
 $stmt=$con->query($sql);
 	$totalrows=$stmt->fetch();
	$total=array_shift($totalrows);
	echo $total;
}
function totaladmins($con){
$sql="select count(*) from admins";
 $stmt=$con->query($sql);
 	$totalrows=$stmt->fetch();
	$total=array_shift($totalrows);
	echo $total;
}
function totalcomments($con){
$sql="select count(*) from comments";
 $stmt=$con->query($sql);
 	$totalrows=$stmt->fetch();
	$total=array_shift($totalrows);
	echo $total;
}
function approvecom($con,$pos){
	$sql="select count(*) from comments where status='ON' and post_id='$pos'";
	$stmt=$con->query($sql);
	$totalcom=$stmt->fetch();
	$aptotal=array_shift($totalcom);
	return $aptotal;
}
function unapprovecom($con,$pos){
	$sql="select count(*) from comments where status='OFF' and post_id='$pos'";
	$stmt=$con->query($sql);
	$totalcom=$stmt->fetch();
	$unaptotal=array_shift($totalcom);
	return $unaptotal;
}
?>
