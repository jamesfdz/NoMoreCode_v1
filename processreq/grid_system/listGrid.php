<?php
    /**
    * Tool Name: Nomorecode
    * Created Date: September 2018
    * Filename: listGrid.php
    * Description: get all grids
    *
    */

    //importing database functions
    require_once("db.php");

    //creating emtpy array for output
    $output = array();
    $first = array();
    $second = array();
    $error_flag = 0;

    //getting post data

    if($error_flag == 0){
        $data = PDO_FetchAll("SELECT * FROM grids");
        if($data != ""){
            for($i = 0 ; $i < count($data); $i++){
                // echo $i;
                $id = $data[$i]["id"];
                $html_code = $data[$i]["html_code"];
                $value = $data[$i]["value"];
                $first[$i] = [$id, $html_code, $value];
            }
        }else{
            $error_flag == 1;
        }
    }

    $output["status"] = $error_flag;
    $output["data"] = $first;
    echo json_encode($output);
?>