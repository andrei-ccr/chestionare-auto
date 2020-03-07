<?php
	include("numaratoare.php");
	include("functions.php");
	
	if(!isset($_SESSION['final'])) {	redirect("/chest/"); die(); }
	
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Final Examen</title>
		<script type="text/javascript" src="jquery-1.10.2.min.js" ></script>
		<script type="text/javascript" src="meniu.js"></script>
		<link href="stylesheets/meniu_css.css" media="all" rel="stylesheet"/>
	</head>
	<body>
		<div id="wrap">
			<div id="container">Examenul a luat sfarsit. Ati fost declarat <?php 
													if($_SESSION['admis']) { echo "<b style=\"color:green;\">ADMIS</b> cu {$_SESSION['rasp_corect']} de puncte!"; } 
													elseif($_SESSION['admis']==false) { echo "<b style=\"color:red;\">RESPINS!</b>"; } ?>
			</div>
			<br><br>
			<?php session_destroy(); ?>
			<div id="alt_chest" class="yellow_but">
				<div style="margin-top: 20px; margin-left: 44px; font-family: Arial; font-size: 15px; font-weight: bold;">Alt chestionar</div>
			</div>
		</div>
			
	</body>
</html>