<?php
    /**
    * Tool Name: Nomorecode
    * Created Date: September 2018
    * Filename: showSnippet.php
    * Description: get all snippet
    *
    */

    //importing database functions
    require_once("db.php");
    require_once("functions.php");

    //setting indian time as default time 
    date_default_timezone_set('Asia/Calcutta');

    //creating emtpy array for output
    $output = array();
    $first = array();
    $second = array();
    $error_flag = 0;

    //getting post data
	$offset = $_POST["offset"];
    
    if($offset == ""){ $offset = 0;}

    if($error_flag == 0){
        $data = PDO_FetchAll("SELECT * FROM snippets Limit 10 OFFSET ".$offset);
        if($data != ""){
            for($i = 0 ; $i < count($data); $i++){
                // echo $i;
                $id = customNonEmpty($data[$i]["id"]);
                $name = customNonEmpty($data[$i]["name"]);
                $html_code = customNonEmpty($data[$i]["html_code"]);
                $image_path = customNonEmpty($data[$i]["image_path"]);
                $storeType = customNonEmpty($data[$i]["storeType"]);
                $first[$i] = [$id, $name, $html_code, $image_path, $storeType];
            }
        }else{
            $error_flag == 1;
        }
    }

    $output["status"] = $error_flag;
    $output["data"] = $first;
    echo json_encode($output);
?>