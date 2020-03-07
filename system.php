<?php
	//Initializare variabile
	include("functions.php");
	include("numaratoare.php");
?>
<?php
	//Extrage din baza, raspunsul corect pentru intrebarea curenta
	if($_SESSION['normal']) { $query = "SELECT * FROM intrebari WHERE id={$_SESSION['id_intreb'][$_SESSION['intrebare']]} LIMIT 1"; }
	elseif($_SESSION['normal'] == false) { $query = "SELECT * FROM intrebari WHERE id={$_SESSION['id_intreb'][$_SESSION['intrebare2']]} LIMIT 1"; }
	
	$stmt = $connection->prepare($query);
	$stmt->execute();
	$data_intrebare = $stmt->fetch(PDO::FETCH_ASSOC);

	//$rasp_corecte contine raspunsul corect pt. intrebarea curenta. Este un array de forma ("nu, "nu", nu").
	$_SESSION['rasp_corecte'] = array($data_intrebare['rasp_a'],$data_intrebare['rasp_b'],$data_intrebare['rasp_c']);

	//Daca nu mai sunt deloc intrebari, anunta finalul ca admis.
	if( ($_SESSION['intreb_afis']<=0) && ($_SESSION['rasp_corect'] >= 22) ) {
					$_SESSION['final'] = true;
					$_SESSION['admis'] = true;
	}
?>
<?php
	//Daca s-a trimis raspuns sau daca s-a apasat butonul 'mai tarziu', incrementeaza '$intrebare'.
	if (isset($_REQUEST["rasp"])) {
		if( $_REQUEST["rasp"] ) {
			$rasp_ales=$_REQUEST['rasp'];
			
			//Verifica daca raspunsul trimis coincide cu raspunsul corect de la intrebarea respictiva. Incrementeaza 'rasp_corect' sau 'rasp_gresit'.
			if ($rasp_ales === $_SESSION['rasp_corecte']) {
				$_SESSION['rasp_corect']++;
			} else {
				if($_COOKIE['mod_corect'] == true) {
					if($_SESSION['corectare'] == FALSE) {$_SESSION['corectare'] = true; $_SESSION['rasp_gresit']++; die(); }
				} 
				else 
				{ 
					$_SESSION['rasp_gresit']++; 
					if($_SESSION['rasp_gresit'] >4) {
						$_SESSION['final'] = true;
						$_SESSION['admis'] = false;
					}
				}
			}
			//Daca finalul nu a fost anuntat, continua incrementarea intrebarilor.
			if($_SESSION['final'] == false) {
			
				//$_SESSION['intrebare'] incepe de la 0;
				//Daca intrebare a fost sub 26 continua sa incrementezi.
				if(($_SESSION['intrebare'] < LIM_INTREB) && ($_SESSION['normal'])) {
					$_SESSION['intrebare']++;
					$_SESSION['intreb_afis']--;

				} 
				//Modul de intrebari sarite
				if(($_SESSION['normal'] == false)&&($_SESSION['intreb_afis']>0)){
					$_SESSION['intrebare2']++;
					$_SESSION['intreb_afis']--;
				}
				//Daca intrebarea a fost 26 (peste 26) intra in modul de intrebari sarite.
				if(($_SESSION['intrebare'] >= LIM_INTREB))
				{
					$_SESSION['normal'] = false;
					
				}
			}
		}
	}
	//Dupa ce intrebarea a fost 'corectata' continua incrementarea normal
	elseif(isset($_REQUEST['corectat']))
	{
		if($_REQUEST['corectat'])
		{
			//Daca sunt 5 rasp gresite, anunta finalul, si seteaza admis = fals.
			if($_SESSION['rasp_gresit'] >4) {
				$_SESSION['final'] = true;
				$_SESSION['admis'] = false;
				
			}
			
			if($_COOKIE['mod_corect'] == true) {
				$_SESSION['corectare'] = false;
			}
			
			//Daca finalul nu a fost anuntat, continua incrementarea intrebarilor.
			if($_SESSION['final'] == false) {
			
				//$_SESSION['intrebare'] incepe de la 0;
				//Daca intrebare a fost sub 26 continua sa incrementezi.
				if(($_SESSION['intrebare'] < LIM_INTREB) && ($_SESSION['normal'])) {
					$_SESSION['intrebare']++;
					$_SESSION['intreb_afis']--;

				} 
				//Modul de intrebari sarite
				if(($_SESSION['normal'] == false)&&($_SESSION['intreb_afis']>0)){
					$_SESSION['intrebare2']++;
					$_SESSION['intreb_afis']--;
				}
				//Daca intrebarea a fost 26 (peste 26) intra in modul de intrebari sarite.
				if(($_SESSION['intrebare'] >= LIM_INTREB))
				{
					$_SESSION['normal'] = false;
					
				}
			}
		}
	}
	//Daca intrebarea a fost sarita, scrie pozitia din array 'id_intreb' in array 'sarite', du-te la urmatoarea intrebare si mareste nr de intrebari sarite.
	elseif(isset($_REQUEST["later"])) {
		if($_REQUEST["later"]) {
			if(($_SESSION['normal'])&&($_SESSION['intrebare'] < 26)) {
				$_SESSION['sarite'][] = $_SESSION['id_curent'];
				$_SESSION['intrebare']++;
			}
			if($_SESSION['normal'] == false) {
				$_SESSION['sarite'][] = $_SESSION['id_curent'];
				$_SESSION['intrebare2']++;
			}
			if(($_SESSION['intrebare'] >= LIM_INTREB)){
				$_SESSION['normal'] = false;
			}
			
		}
	}
	//Se intampla numai daca timpul a expirat
	elseif(isset($_REQUEST["respins"])) {
		if($_REQUEST["respins"]) {
			$_SESSION['final'] = true;
			$_SESSION['admis'] = false;	
			$_SESSION['expirat'] = true;
		}
	}
	
	
	
	//Mai verifica o data numaratoarea. Rezolva problema cu a 27-a intrebare.
	if( ($_SESSION['intreb_afis']<=0) && ($_SESSION['rasp_corect'] >= 22) ) {
					$_SESSION['final'] = true;
					$_SESSION['admis'] = true;
	}
	


	
	mysql_close();
?>