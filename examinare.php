<?php
	session_start();
	session_destroy();
	if($_GET['c'] > 0) { setcookie("mod_corect",true); }
	else { setcookie("mod_corect",false); }
	
	
	header("Location: chestionar.php");
	exit();

?>