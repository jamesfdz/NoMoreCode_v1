<?php
    /**
    * Tool Name: Nomorecode
    * Created Date: September 2018
    * Filename: addSnippet.php
    * Description: save snippet
    *
    */

    //importing database functions
    require "db.php";

    //setting indian time as default time 
    date_default_timezone_set('Asia/Calcutta');

    //creating emtpy array for output
    $output = array();
    $error_flag = 0;

    //getting post data
	$image = $_POST["image"];
    $html = $_POST["html"];
    $storeType = $_POST["storeType"];
    $currentTime = date('m_d_Y_h_i_a');

    if($image != ""){
        //require this functin to save this image 
        require 'base64ToImage.php';
        $image = base64_to_jpeg($image, "snippet_images/".$currentTime.".jpeg");
        if($image == ""){
            $error_flag = 1;
        }
    }else{
        $image = "-";
    }

    if($error_flag == 0){
        $query = "INSERT INTO snippets(name, image_path, html_code, storeType) VALUES ('Veeva', '".$image."', '".$html."', ".$storeType.")";

        $query = trim($query);

        $stmt = @PDO_Execute($query);
        if (!$stmt || ($stmt && $stmt->errorCode() != 0)) {
            // $error = PDO_ErrorInfo();
            $error_flag == 1;
            @unlink("snippet_images/".$currentTime.".jpeg");
        }
    }

    $output["status"] = $error_flag;
    echo json_encode($output);
?>