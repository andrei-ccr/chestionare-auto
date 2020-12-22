<?php
	session_start();
	session_unset();

	if($_GET['c'] > 0) $_SESSION['modcorectare'] = true;
	else $_SESSION['modcorectare'] = false;
	
	header("Location: chestionar.php");
	exit();

?>