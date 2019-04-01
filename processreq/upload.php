<?php
    /**
    * Tool Name: Nomorecode
    * Created Date: September 2018
    * Filename: savePreview.php
    * Description: save Preiview in ouput folder
    *
    */

    //notice will ignore to avoid wrong json data issue
    error_reporting(E_ALL & ~E_NOTICE);
    
    $name = array();
    $output = array();

    $targetDir = "../images/";
    $allowTypes = array('jpg', 'JPG' ,'png', 'PNG', 'jpeg', 'JPEG' ,'gif', 'GIF');
    
    $images_arr = array();
    foreach($_FILES['images']['name'] as $key=>$val){
        $image_name = $_FILES['images']['name'][$key];
        $tmp_name   = $_FILES['images']['tmp_name'][$key];
        $size       = $_FILES['images']['size'][$key];
        $type       = $_FILES['images']['type'][$key];
        $error      = $_FILES['images']['error'][$key];
        
        // File upload path
        $fileName = basename($_FILES['images']['name'][$key]);
        $targetFilePath = $targetDir . $fileName;
        
        // Check whether file type is valid
        $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
        if(in_array($fileType, $allowTypes)){    
            // Store images on the server
            if(move_uploaded_file($_FILES['images']['tmp_name'][$key],$targetFilePath)){
                $images_arr[] = $targetFilePath;
            }
        }
    }
    
    // Generate gallery view of the images
    if(!empty($images_arr))
    {
        foreach($images_arr as $image_src)
        {
             $name[] = $image_src;
        }
    }
?>
