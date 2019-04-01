<?php
	/**
	* Tool Name: Nomorecode
	* Created Date: September 2018
	* Filename: triggerCMD.php
	* Description: This file will trigger jar file for pdf processing
	*
	*/

	//notice will ignore to avoid wrong json data issue
	error_reporting(E_ALL & ~E_NOTICE);

    $command = 'java -jar "'.getcwd().'\pdf2img.jar"';
    exec($command);
    exit();
?>