<?php
	/**
	* Tool Name: Nomorecode
	* Created Date: September 2018
	* Filename: getIpAddress.php
	* Description: To provide current systems IP address and port number to access it from another pc in same lan connection.
	*
	*/

	//notice will ignore to avoid wrong json data issue
	error_reporting(E_ALL & ~E_NOTICE);

	//creating emtpy array for output
    $output = array();

    //getting port number and hostname
    $output["url"] = getHostByName(getHostName()) .":".$_SERVER['SERVER_PORT'] ;
    

    //convert all ouput array to json format and exit
    if($output["url"] != "") {
    	$output["status"] = 0 ;	
    } else {
    	$output["status"] = 1 ;
    }
  
    echo json_encode($output);
?>