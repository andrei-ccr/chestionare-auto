$(document).ready(function() {
	var rasp1 = 'nu';
	var rasp2 = 'nu';
	var rasp3 = 'nu';
	$("#r_a").click( function() {
		$(this).data('sel',true);
		$(this).addClass('sel_a');
		rasp1 = 'da';
		$("#v_a").addClass("highlight");
	
	});
	
	$("#r_b").click( function() {
		$(this).data('sel',true);
		$(this).addClass('sel_b');
		rasp2 = 'da';
		$("#v_b").addClass("highlight");
		
	});
	
	$("#r_c").click( function() {
		$(this).data('sel',true);
		$(this).addClass('sel_c');
		rasp3 = 'da';
		$("#v_c").addClass("highlight");
	});
	
	$("#trimit_raspunsul").click( function() {
		if(($("#r_a").data('sel')) || ($("#r_b").data('sel')) || ($("#r_c").data('sel'))){
			
			$.get("system.php",{ 'rasp[]': [rasp1,rasp2,rasp3]},function(data) {
				location.reload();
			});
		}
		
	});
	
	$("#sterg_raspunsul").click( function() {
		rasp1 = 'nu';
		rasp2 = 'nu';	
		rasp3 = 'nu';
		$("#r_a").removeClass("sel_a");
		$("#r_b").removeClass("sel_b");
		$("#r_c").removeClass("sel_c");
		$("#r_a").removeData('sel');
		$("#r_b").removeData('sel');
		$("#r_c").removeData('sel');
		$("#v_a").removeClass('highlight');
		$("#v_b").removeClass('highlight');
		$("#v_c").removeClass('highlight');
	});
	
	$("#mai_tarziu").click( function() {
		$.get("system.php",{ later: "1" },function(data) {
			location.reload();
		});
	});
});