<?php 
	header('Content-type: application/json');
	session_start();
	if($_SESSION['corectare'] == true) {
		$highlight = $_SESSION['rasp_corecte'];
		if($highlight[0] == "da") { $high1 = "d"; } else { $high1 = "n"; }
		if($highlight[1] == "da") { $high2 = "d"; } else { $high2 = "n"; }
		if($highlight[2] == "da") { $high3 = "d"; } else { $high3 = "n"; }
	} else {
		$high1 = "n";
		$high2 = "n";
		$high3 = "n";
	}
	
	echo json_encode(array("high1"=>$high1,"high2"=>$high2,"high3"=>$high3));

?>