<?php
	//Connect to database
	$cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
	
	define("DB_SERVER", $cleardb_url["host"]);
	define("DB_USER", $cleardb_url["user"]);
	define("DB_PASS", $cleardb_url["pass"]);
	define("DB_NAME", substr($cleardb_url["path"],1));
?>