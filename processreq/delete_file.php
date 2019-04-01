<?php
	/**
	* Tool Name: Nomorecode
	* Created Date: September 2018
	* Filename: delete_file.php
	* Description: deleting file in prjects folder
	*
	*/

	//notice will ignore to avoid wrong json data issue
	error_reporting(E_ALL & ~E_NOTICE);

	//creating emtpy array for output
    $output = array();
    
    //Getting post data
    $filename = $_POST["filename"];
    
    //removing file
    if(@unlink('../projects/'.$filename)){
        $output["status"] = 0;    
    }else{
        $output["status"] = 1;    
    }

    //convert all ouput array to json format and exit
    echo json_encode($output);
?>