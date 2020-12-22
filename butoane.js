$(document).ready(function() {
	var rasp1 = 'nu';
	var rasp2 = 'nu';
	var rasp3 = 'nu';
	$("#v_a").click( function() {
		$(this).data('sel',true);
		$(this).addClass('sel_a');
		rasp1 = 'da';
		$("#v_a").addClass("highlight");
	
	});
	
	$("#v_b").click( function() {
		$(this).data('sel',true);
		$(this).addClass('sel_b');
		rasp2 = 'da';
		$("#v_b").addClass("highlight");
		
	});
	
	$("#v_c").click( function() {
		$(this).data('sel',true);
		$(this).addClass('sel_c');
		rasp3 = 'da';
		$("#v_c").addClass("highlight");
	});
	
	$("#trimit_raspunsul").click( function() {
		if(($("#v_a").data('sel')) || ($("#v_b").data('sel')) || ($("#v_c").data('sel'))){
			
			$.get("system.php",{ 'rasp[]': [rasp1,rasp2,rasp3]},function(data) {
				location.reload();
			});
		}
		
	});
	
	$("#sterg_raspunsul").click( function() {
		rasp1 = 'nu';
		rasp2 = 'nu';	
		rasp3 = 'nu';
		$("#v_a").removeClass("sel_a");
		$("#v_b").removeClass("sel_b");
		$("#v_c").removeClass("sel_c");
		$("#v_a").removeData('sel');
		$("#v_b").removeData('sel');
		$("#v_c").removeData('sel');
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