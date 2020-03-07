<?php
	include("functions.php");
	include("numaratoare.php");
	
	//Daca variabila 'final' este setata, incheie examenul.
	if(isset($_SESSION['final'])) {
		if($_SESSION['final']) {
			redirect("final.php");
		}
	}
	if($_SESSION['chestionar_alc'] != true) {
		//Determina cate intrebari exista in baza de date
		$stmt = $connection->prepare("SELECT id FROM intrebari ORDER BY id DESC LIMIT 1");
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		$nr_intrebari = $result['id'];
		
		for($i=0;$i<26;$i++) { $_SESSION['id_intreb'][$i] = 0; }
		
		$a = range(1,$nr_intrebari);
		shuffle($a); shuffle($a);
		
		for($i=0;$i<26;$i++) { $_SESSION['id_intreb'][$i] = $a[$i]; }
		
		//for($i=0;$i<26;$i++) { $_SESSION['id_intreb'][$i] = 1; }  //Depanare: chestionar alc. doar din prima intrebare. Comenteaza
		
		$_SESSION['chestionar_alc'] = true;
	}

	if($_SESSION['normal']) { /*$_SESSION['id_intreb'] = explode("," , $chestionarul['intreb']);*/ /* Array care contine id-urile intrebarilor din chestionarul ales*/ }
	elseif ($_SESSION['normal'] == false) { $_SESSION['id_intreb'] = $_SESSION['sarite'];}
	
	//Extrage cerinta si raspunsurile din database
	if($_SESSION['normal']) { $_SESSION['id_curent'] = $_SESSION['id_intreb'][$_SESSION['intrebare']]; }
	elseif($_SESSION['normal'] == false) { $_SESSION['id_curent'] = $_SESSION['id_intreb'][$_SESSION['intrebare2']]; }
	if($_SESSION['normal']) {
		$query = "SELECT * FROM intrebari WHERE id={$_SESSION['id_intreb'][$_SESSION['intrebare']]} LIMIT 1";
		$nr_intrebare = array_search($_SESSION['intrebare'],$_SESSION['id_intreb']);
	}
					
	elseif($_SESSION['normal'] == false) {
		$query = "SELECT * FROM intrebari WHERE id={$_SESSION['id_intreb'][$_SESSION['intrebare2']]} LIMIT 1";
		$nr_intrebare = array_search($_SESSION['intrebare2'],$_SESSION['id_intreb']);
	}	
	$stmt = $connection->prepare($query);
	$stmt->execute();
	$o_intrebare = $stmt->fetch(PDO::FETCH_ASSOC);
	
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Testare</title>
		<script type="text/javascript" src="jquery-1.10.2.min.js" ></script>
		<script type="text/javascript" src="jquery.countdown.min.js" ></script>
		<?php if($_SESSION['corectare'] == false) { echo "<script type=\"text/javascript\" src=\"butoane.js\"></script>"; } else { echo "<script type=\"text/javascript\" src=\"corectare.js\"></script>"; } ?>
		<script type="text/javascript" src="timer.js"></script>
		<link href="stylesheets/chestionar_css.css" media="all" rel="stylesheet"/>
	</head>
	<body>
		<br/>
		<div id="status">
			<ul>
				<li>Intrebari ramase: <span id="intreb_nr"><?php echo $_SESSION['intreb_afis']+1; ?></span></li>
				<li>Raspunsuri corecte: <span id="intreb_corecte"><?php echo $_SESSION['rasp_corect'];?></span></li>
				<li>Raspunsuri gresite: <span id="intreb_gresite"><?php echo $_SESSION['rasp_gresit'];?></span></li>
				
				<!--<li>Array Sarite: <span id="intreb_nr"><?php print_r ($_SESSION['sarite']); ?></span></li>
				<li>Intrebari1: <span id="intreb_corecte"><?php echo   $_SESSION['intrebare']; ?></span></li>
				<li>Intrebari2: <span id="intreb_gresite"><?php echo $_SESSION['intrebare2'];?></span></li>
				<li>Normal: <span id="intreb_gresite"><?php echo $_SESSION['normal'];?></span></li>-->
				
				<li>Timp ramas: <span id="timp"></span></li>
			</ul>
		</div>
		<div id="wrapper">
			<div id="intrebare">
				<?php 
					
				?>
				<div id="cerinta">
					<?php 
						if( $o_intrebare['imagine'] != NULL ) {
							echo "<div id=\"text\" style=\"width:650px;\"><h4>{$o_intrebare['cerinta']}</h4></div>";
							echo "<div id=\"img\"><img src=\"{$o_intrebare['imagine']}\"></div>";
						}
						else
						{
							echo "<div id=\"text\" style=\"width:1050px;\"><h4>{$o_intrebare['cerinta']}</h4></div>";
						}
					?>	
				</div>
				<div id="raspunsuri">
					<?php
						echo "<h5>&nbsp;&nbsp;Variante de raspuns</h5>";
						echo $o_intrebare['variante'];
					?>
				</div>
			</div>
			<br/>
			
			
			<div id ="butoane">
			<ul>
				<li><div id="r_a" class="rasp_a"></div></li>
				<li><div id="r_b" class="rasp_b"></div></li>		
				<li><div id="r_c" class="rasp_c"></div></li>
			</ul>
			</div>

			<?php if($_SESSION['corectare'] == false) { echo "
			<div id=\"trimite\">
				<div id=\"mai_tarziu\">
					<div style=\"margin-top: 20px; margin-left: 44px; font-family: Arial; font-size: 15px; font-weight: bold;\">Raspund mai tarziu</div>
				</div>

				<div id=\"sterg_raspunsul\">
					<div style=\"margin-top: 20px; margin-left: 42px; font-family: Arial; font-size: 15px; font-weight: bold;\">Sterg raspunsul</div>	
				</div>

				<div id=\"trimit_raspunsul\">
					<div style=\"margin-top: 20px; margin-left: 42px; font-family: Arial; font-size: 15px; font-weight: bold;\">Trimit raspunsul</div>
				</div>
			</div>
			"; 
			} else {
				echo "
			<div id=\"trimite\">
				<div id=\"trimit_raspunsul\">
					<div style=\"margin-top: 20px; margin-left: 42px; font-family: Arial; font-size: 15px; font-weight: bold;\">Mai departe</div>
				</div>
			</div>
			";
			}
			?>
			
			
		</div>
	</body>
</html>