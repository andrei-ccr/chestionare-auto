
	var secs;
	$.get("timp.php", function(data) {
		secs = data;
		$('#timp').countdown({
			until: secs ,compact: true, onExpiry: respinge
		});
	});

	
	function respinge() {
		$.get("system.php",{ respins: "1" }, function() {
			location.reload();
		});
	}
