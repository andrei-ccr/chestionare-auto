$(document).ready(function() {
	$("#alt_chest").click( function() {
		window.location.replace("/");
	});

	$("#btn-start").click( function() {
		if( $('#afisare_rasp').prop('checked') ) {
			window.location.replace("examinare.php?c=1");
		}
		else {
			window.location.replace("examinare.php?c=0");
		}
	});
});