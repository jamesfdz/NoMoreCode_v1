<?php
    /**
    * Tool Name: Nomorecode
    * Created Date: September 2018
    * Filename: deleteImages.php
    * Description: deleting images in 'images' directory
    *
    */

    //notice will ignore to avoid wrong json data issue
    error_reporting(E_ALL & ~E_NOTICE);

    //creating emtpy array for output
    $filenames = array();
    $data = array();
    $output = array();

    //directory path
    $image_path = "../images/";
    
    //getting post data
    $filenames = $_POST['filenames'];
    
    // for loop on filenames array to get each file
    for($i=0 ; $i < count($filenames) ; $i++)
    {
        $data[$i]["filename"] = $filenames[$i]; 
        $data[$i]["status"] = 1;

        //if files is present then remove it
        if (file_exists($image_path.$filenames[$i])) {
            if(@unlink($image_path.$filenames[$i])){
                $data[$i]["status"] = 0;
            }
        } 
    }

    //convert all ouput array to json format and exit
    $output["data"] = $data;
    echo json_encode($output);
?>