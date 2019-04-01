<?php
    /**
    * Tool Name: Nomorecode
    * Created Date: September 2018
    * Filename: clearExistingPDF.php
    * Description: clearing existing image and json files which extracted from pdf in processreq folder
    *
    */
    
    //notice will ignore to avoid wrong json data issue
    error_reporting(E_ALL & ~E_NOTICE);

    //creating emtpy array for output
    $output = array();

    //output variable if success is 0 mean this script run successfully without having any issue.
    $output["status"] = 0;

    //variable containing directory name
    $dir = "../processreq/";

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

                // if extention is "png" or "json" then removing those files
                if($ext == "png" || $ext == "json")
                {
                    //removing file
                    @unlink($dir.$filename);
                }
            }
        }
    }

    //convert all ouput array to json format and exit
    echo json_encode($output);
?>