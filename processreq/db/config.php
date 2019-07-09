<?php
	
	date_default_timezone_set('Asia/Calcutta');	
	// error_reporting(E_ALL & ~E_NOTICE);

	$rootPath = $_SERVER["DOCUMENT_ROOT"];
	$httpRoot = $_SERVER["HTTP_HOST"];

	define("SITE_NAME", "NMC");

	// define("COMPONENT_PATH", $rootPath . "/components/");
	define("PROCESSREQ_PATH", $rootPath . "/processreq/");
	define("LIBRARY_PATH", $rootPath . "/processreq/db/");
	define("DATABASE_PATH", $rootPath . "/processreq/db/");
	// define("API_PATH", $rootPath . "/processreq/");
	// define("IMG_PATH", $rootPath . "/img/");
	// define("TEMPLATE_PATH", 'http://' . $_SERVER['HTTP_HOST'] . '/processreq/template.php' );

	// define("OUTPUT_PATH", $rootPath . "/output/");
	// define("OUTPUT_PATH_HTTP", $httpRoot . "/output/");
	// define("OUTPUT_SHARED_COMPONENT_PATH", "/030C/Shared-Content");
	// define("OUTPUT_SINGLE_COMPONENT_PATH", "/030C/Single-Content");
	// define("OUTPUT_IMAGES_PATH", "/static/images");
	// define("OUTPUT_CSS_PATH", "/static/css");
	// define("OUTPUT_JS_PATH", "/static/js");
	
	// define("DEMO_IMG_PATH", $rootPath . "/static/images/");
	// define("DEMO_BASE_PATH_HOST", 'http://' . $_SERVER['HTTP_HOST'] . "/demo/");
	// define("DEMO_IMG_PATH_HOST", 'http://' . $_SERVER['HTTP_HOST'] . "/demo/static/images/");
	// define("MAIN_CSS_PATH", $rootPath . "/static/css/main.css");
	// define("MAIN_JS_PATH", $rootPath . "/static/js/main.js");


?>