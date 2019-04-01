<?php
	/**
	* Tool Name: Nomorecode
	* Created Date: September 2018
	* Filename: import.php
	* Description: This script will import zip file and convert into folder structure
	*
	*/
	
	//notice will ignore to avoid wrong json data issue
	error_reporting(E_ALL & ~E_NOTICE);

	//setting indian time as default time 
	date_default_timezone_set('Asia/Calcutta');

	//variable to hold error count
	$error = 0;

	//standard zip reading code for php
	if($_FILES["importZipInput"]["tmp_name"]){
		//getting zip file name
		$filename = $_FILES["importZipInput"]["name"];
		
		//getting temp name to store
		$source = $_FILES["importZipInput"]["tmp_name"];

		//getting zip types
		$type = $_FILES["importZipInput"]["type"];

		//getting extention
		$name = explode(".", $filename);

		// if mime type ie zip file is different than the below type then show error
		$accepted_types = array('application/zip', 'application/x-zip-compressed', 'multipart/x-zip', 'application/x-compressed');
		foreach($accepted_types as $mime_type) {
		    if($mime_type != $type) {
				$error = 1;
				$message = "ErrorCode : 101 The file you are trying to upload is not a valid .zip file. Please try again.";
		    } else{
		    	break;
		    }
		}

		//if file extention is not zip then exit script
		$continue = strtolower($name[1]) == 'zip' ? true : false;
	    if(!$continue) {

	        $message = "ErrorCode : 102 The file you are trying to upload is not a .zip file. Please try again.";
	        $error = 1;
	        $output["status"] = $error;
	        $output["message"] = $message;
	        echo json_encode($output);
	        exit();
	    }

	    //path to move zip in tool folder
	    $imported_path = "../imported_projects/".$filename."_".date('m_d_Y_h_i_a').".zip";

	    if(move_uploaded_file($source, $imported_path )) {
		    //standard zip reading operations
		    $zip = new ZipArchive;
		    
		    //open zip file and extract to output folder
		    $res = $zip->open($imported_path);
		    
		    if ($res === TRUE) {

		    	$zip->extractTo('../imported_projects/processing');
		    	$zip->close();

		    	$error = 0;
		    	$message = "File imported successfully";

		    	$dir_image = "../imported_projects/processing/images";
		    	//check whether directory is true or not
		    	if(is_dir($dir_image))
		    	{
		    	    //if true then open directory and create instance variable
		    	    if($handle = opendir($dir_image))
		    	    {
		    	        //checking directory
		    	        chdir($dir_image);

		    	        //getting filename of all files which is present in folder
		    	        array_multisort(array_map('filemtime', ($files = glob("*.*"))), SORT_DESC, $files);

		    	        //loop on all filenames
		    	        foreach($files as $filename)
		    	        {
		    	            //getting extention name
		    	        	$ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

		    	            // if extention is not jar it means no java file present and make success variable to 1
		    	        	if($ext == "png" || $ext == "jpg" || $ext == "jpeg" || $ext == "gif")
		    	        	{
	    	        			@copy($filename, "../../../images/".$filename);
	    	        			@unlink($filename);	
		    	        	}
		    	        }
		    	    }
		    	}

		    	//variable containing directory name
		    	$dir = "../";

		    	//check whether directory is true or not
		    	if(is_dir($dir))
		    	{
		    	    //if true then open directory and create instance variable
		    	    if($handle = opendir($dir))
		    	    {
		    	        //checking directory
		    	        chdir($dir);

		    	        //getting filename of all files which is present in folder
		    	        array_multisort(array_map('filemtime', ($files = glob("*.*"))), SORT_DESC, $files);

		    	        //loop on all filenames
		    	        foreach($files as $filename)
		    	        {
		    	            //getting extention name
		    	        	$ext = pathinfo($filename, PATHINFO_EXTENSION);

		    	            // if extention is not jar it means no java file present and make success variable to 1
		    	        	if($ext == "html")
		    	        	{
		    	        		//reading index.html file and stored in variable in imported zip 
		    	        		$myfile = fopen($filename, "r");
		    	        		if($myfile){
		    	        			$htmlFile = "";
		    	        			while(!feof($myfile)) {
		    	        			  $htmlFile .= fgets($myfile);
		    	        			}
		    	        			fclose($myfile);
		    	        			@unlink($filename);	
		    	        		}else{
		    	        			$error = 1;
		    	        			$message = "ErrorCode : 103 Something went wrong while uploading file.";

		    	        			$output["status"] = $error;
		    	        			$output["message"] = $message;
		    	        			echo json_encode($output);
		    	        			exit();
		    	        		}
		    	        	}
		    	        }
		    	    }
		    	}
		    	
		    	//delete temp imported zip
		    	@unlink('../'.$imported_path);
		    	
		    } else {
		     	$error = 1;
		     	$message = "ErrorCode : 104 Something went wrong while Opening html file in zip.";

		     	$output["status"] = $error;
		     	$output["message"] = $message;
		     	echo json_encode($output);
		     	exit();
		    }
		}else{
			$error = 1;
			$message = "ErrorCode : 105 Something went wrong while uploading file.";
		}
	}

	// convert all ouput array to json format and exit
	$output["status"] = $error;
	$output["message"] = $message;

	if($htmlFile){
		$temp_htmlFile = $htmlFile;

		//array of data which need to replace
		$ascii_char_array = ["&#00038;", "&#00045;", "&#00174;", "&#00169;", "&#00034;", "&#08482;", "&#08804;", "&#08805;", "&#00060;", "&#00062;", "&#00042;", "&#08226;", "&#00239;", "&#08211;", "&#08217;", "&#00177;", "&#08212;", "&#00126;", "&#08213;", "&#08224;", "&#08225;", "&#00167;", "&#00039;"];

		//array of data which need to be replace by this
		$ascii_class_array = ['<span class="ascii_char">&#00038;</span>', '<span class="ascii_char">&#00045;</span>', '<span class="ascii_char">&#00174;</span>', '<span class="ascii_char">&#00169;</span>', '<span class="ascii_char">&#00034;</span>', '<span class="ascii_char">&#08482;</span>', '<span class="ascii_char">&#08804;</span>', '<span class="ascii_char">&#08805;</span>', '<span class="ascii_char">&#00060;</span>', '<span class="ascii_char">&#00062;</span>', '<span class="ascii_char">&#00042;</span>', '<span class="ascii_char">&#08226;</span>', '<span class="ascii_char">&#00239;</span>', '<span class="ascii_char">&#08211;</span>', '<span class="ascii_char">&#08217;</span>', '<span class="ascii_char">&#00177;</span>', '<span class="ascii_char">&#08212;</span>', '<span class="ascii_char">&#00126;</span>', '<span class="ascii_char">&#08213;</span>', '<span class="ascii_char">&#08224;</span>', '<span class="ascii_char">&#08225;</span>', '<span class="ascii_char">&#00167;</span>', '<span class="ascii_char">&#00039;</span>'];


		$temp_htmlFile = str_replace($ascii_char_array, $ascii_class_array, $temp_htmlFile);
		$htmlFile = $temp_htmlFile;
	}
	
	//send imported index.html file to json output
	$output["htmlData"] = $htmlFile;
	echo json_encode($output);
	exit();
?>