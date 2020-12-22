<?php
	//Connect to database
	/*$cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
	
	define("DB_SERVER", $cleardb_url["host"]);
	define("DB_USER", $cleardb_url["user"]);
	define("DB_PASS", $cleardb_url["pass"]);
	define("DB_NAME", substr($cleardb_url["path"],1));*/


	
	define("DB_SERVER", "127.0.0.1");
	define("DB_USER", "root");
	define("DB_PASS", "");
	define("DB_NAME", "chestionare");
?>