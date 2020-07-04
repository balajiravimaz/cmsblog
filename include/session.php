<?php
session_start();

function ErrorMsg(){
	if(isset($_SESSION['ErrorMsg'])){
		$output = "<div class=\"alert alert-danger\">";
		$output .=htmlentities($_SESSION['ErrorMsg']);
		$output .="</div>";
		$_SESSION['ErrorMsg']=null;	
		return $output;
	}
}

function SuccessMsg(){
	if(isset($_SESSION['SuccessMsg'])){
		$output = "<div class=\"alert alert-success\">";
		$output .=htmlentities($_SESSION['SuccessMsg']);
		$output .="</div>";
		$_SESSION['SuccessMsg']=null;	
		return $output;
	}
}
?>