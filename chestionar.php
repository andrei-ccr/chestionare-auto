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
		<script
			  src="https://code.jquery.com/jquery-1.12.4.min.js"
			  integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
			  crossorigin="anonymous"></script>
		<script type="text/javascript" src="jquery.countdown.min.js" ></script>
		<?php if($_SESSION['corectare'] == false) { echo "<script type=\"text/javascript\" src=\"butoane.js\"></script>"; } else { echo "<script type=\"text/javascript\" src=\"corectare.js\"></script>"; } ?>
		<script type="text/javascript" src="timer.js"></script>
		<link href="stylesheets/chestionar_css.css" media="all" rel="stylesheet"/>
	</head>
	<body>
		<div id="status">
			<div> <span>26</span> Intrebari initiale</div>
			<div><span id="intreb_nr"><?php echo $_SESSION['intreb_afis']+1; ?></span> Intrebari ramase </div>
			<div><span id="timp"></span></div>
			
			<div><span id="intreb_corecte"><?php echo $_SESSION['rasp_corect'];?></span> Raspunsuri corecte</div>
			<div><span id="intreb_gresite"><?php echo $_SESSION['rasp_gresit'];?></span> Raspunsuri gresite </div>
			
			<!--<li>Array Sarite: <span id="intreb_nr"><?php print_r ($_SESSION['sarite']); ?></span></li>
			<li>Intrebari1: <span id="intreb_corecte"><?php echo   $_SESSION['intrebare']; ?></span></li>
			<li>Intrebari2: <span id="intreb_gresite"><?php echo $_SESSION['intrebare2'];?></span></li>
			<li>Normal: <span id="intreb_gresite"><?php echo $_SESSION['normal'];?></span></li>-->

		</div>
		<div id="wrapper">
			<div id="intrebare">
				<div id="cerinta">
					<?php 
						echo '<div id="text">' . $o_intrebare['cerinta'] . '</div>';
					?>	
				</div>
				<div id="raspunsuri">
					<div>
					<?php
						echo $o_intrebare['variante'];
					?>
					</div>
					<?php 
						if( $o_intrebare['imagine'] != NULL ) {
							echo '<div id="img"><img src="' . $o_intrebare['imagine'] . '"></div>';
						}
					?>
				</div>
			</div>


			<?php if($_SESSION['corectare'] == false) : ?> 

				<div id="trimite">
					<div id="mai_tarziu">
						Raspund mai tarziu
					</div>

					<div id="sterg_raspunsul">
						Modifica raspunsul	
					</div>

					<div id="trimit_raspunsul">
						Trimite raspunsul
					</div>
				</div>
			
			<?php else : ?>
				
				<div id="trimite">
					<div id="trimit_raspunsul">
						Urmatoarea intrebare
					</div>
				</div>
			
			<?php endif; ?>
			
			
		</div>
	</body>
</html>