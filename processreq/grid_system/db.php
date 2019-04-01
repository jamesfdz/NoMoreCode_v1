<?php
	//notice will ignore to avoid wrong json data issue
	error_reporting(E_ALL & ~E_NOTICE);

	//importing database functions
	require_once("../db/_pdo.php");

	$db_file = "grids.db";

	PDO_Connect("sqlite:$db_file");
	// print("PDO_Connect(): successsfully connected<br>");

	$query = "CREATE TABLE IF NOT EXISTS grids (
				    id INTEGER PRIMARY KEY,
				    html_code TEXT NOT NULL,
				    value TEXT NOT NULL
				)";

	$query = trim($query);

	$stmt = @PDO_Execute($query);
	if (!$stmt || ($stmt && $stmt->errorCode() != 0)) {
	    $error = PDO_ErrorInfo();
	    print_r($error[2]);exit();
	}

?>