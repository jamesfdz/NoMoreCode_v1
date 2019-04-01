<?php
    /**
    * Tool Name: Nomorecode
    * Created Date: September 2018
    * Filename: checkFiles.php
    * Description: checking files processreq folder
    *
    */

    //notice will ignore to avoid wrong json data issue
    error_reporting(E_ALL & ~E_NOTICE);

    //creating emtpy array for output
    $output = array();

    //output variable if success is 0 mean this script run successfully without having any issue.
    $success = 0;

    //variable containing directory name
    $dir = "java/";

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
            	if($ext != "jar")
            	{
            		$success = 1;
            	}
            }
        }
    }

    //push all data into output array
    $output["success"] = $success;

    //convert all ouput array to json format and exit
    echo json_encode($output);
    exit();
?>