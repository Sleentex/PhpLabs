<?php 
	define("DB_HOST", "localhost");
	define("DB_USERNAME", "root");
	define("DB_PASSWORD", "");
	define("DB_NAME", "educational_subjects");

	$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

	if ($mysqli->connect_errno) {
		die("Не удалось подключиться: " . $mysqli->connect_error);
	} 
?>