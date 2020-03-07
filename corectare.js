$(document).ready(function() {
	$.getJSON("corectare.php", function(response) {
		var rasp1 = response.high1;
		var rasp2 = response.high2;
		var rasp3 = response.high3;
		
		if(rasp1 == 'd') {
		$("#v_a").addClass("highlight2");
		$("#r_a").addClass("sel_a");
		}
		if(rasp2 == 'd') {
			$("#v_b").addClass("highlight2");
			$("#r_b").addClass("sel_b");
		}
		if(rasp3 == 'd') {
			$("#v_c").addClass("highlight2");
			$("#r_c").addClass("sel_c");
		}
	});
	/*rasp1 = "d";
	rasp2 = "n";
	rasp3 = "d";*/

	
	$("#trimit_raspunsul").click( function() {
		$.get("system.php",{corectat: "2"}, function(data) {
			location.reload();
		});
	});
});