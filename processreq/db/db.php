<?php
	//notice will ignore to avoid wrong json data issue
	error_reporting(E_ALL & ~E_NOTICE);

	//importing database functions
	require "_pdo.php";

	$db_file = "snippet.db";
	PDO_Connect("sqlite:$db_file");
	// print("PDO_Connect(): successsfully connected<br>");

	$query = "CREATE TABLE IF NOT EXISTS snippets (
				    id INTEGER PRIMARY KEY,
				    name TEXT NOT NULL,
				    image_path TEXT,
				    html_code TEXT,
				    storeType TEXT
				)";

	$query = trim($query);

	$stmt = @PDO_Execute($query);
	if (!$stmt || ($stmt && $stmt->errorCode() != 0)) {
	    $error = PDO_ErrorInfo();
	    print_r($error[2]);exit();
	}

?>