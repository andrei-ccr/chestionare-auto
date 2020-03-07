<?php	
	include("functions.php");
	if(!isset($_SESSION['exp'])) { 
		$_SESSION['exp'] = time() + 1800;
	}
	
	$_SESSION['left_str'] = "\"+";
	$_SESSION['left_str'] .= $_SESSION['exp'] - time();
	$_SESSION['left_str'] .= "s\"";
	echo $_SESSION['left_str'];
?>