<?php
	include("numaratoare.php");
	include("functions.php");
	
	if(!isset($_SESSION['final'])) {	redirect("/"); die(); }
	
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Final Examen</title>
		<script
			  src="https://code.jquery.com/jquery-1.12.4.min.js"
			  integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
			  crossorigin="anonymous"></script> 
		<script type="text/javascript" src="meniu.js"></script>
		<link href="stylesheets/meniu_css.css" media="all" rel="stylesheet"/>
	</head>
	<body>
		<div id="wrap">
			Examenul a luat sfarsit. Ati fost declarat 
			<?php 
				if($_SESSION['admis']) { echo '<strong style="color:green;">ADMIS</strong> cu ' . $_SESSION['rasp_corect'] . ' de puncte!'; } 
				elseif($_SESSION['admis'] == false) { echo '<strong style="color:red;">RESPINS!</strong>'; } ?>
			
			<?php session_destroy(); ?>
			<div id="alt_chest" class="button">
				Incepe alt examen
			</div>
		</div>
			
	</body>
</html>