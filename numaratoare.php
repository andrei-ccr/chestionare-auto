<?php 

	if(!isset($_SESSION['intrebare'])) {
		$_SESSION['intrebare'] = 0;
		$_SESSION['intrebare2'] = 0;
		$_SESSION['rasp_corect'] = 0;
		$_SESSION['rasp_gresit'] = 0;
		$_SESSION['intreb_afis'] = 25;
		$_SESSION['normal'] = true;
		$_SESSION['chestionar_alc'] = false;
		$_SESSION['corectare'] = FALSE;
		
	}

?>