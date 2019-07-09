<?php
    /**
    * Tool Name: Nomorecode
    * Created Date: September 2018
    * Filename: addSnippet.php
    * Description: save snippet
    *
    */

    //importing database functions
    require_once("db.php");

    //setting indian time as default time 
    // date_default_timezone_set('Asia/Calcutta');

    //creating emtpy array for output
    $output = array();
    $error_flag = 0;

    //getting post data
    $id = $_POST["id"];

    if( $id == "" ){
        $error_flag = 1;
        $output["status"] = $error_flag;
        echo json_encode($output);
        exit;
    }

    if($error_flag == 0){
        $query = "DELETE FROM snippets WHERE id = ".$id;

        $query = trim($query);

        $stmt = @PDO_Execute($query);
        if (!$stmt || ($stmt && $stmt->errorCode() != 0)) {
            // $error = PDO_ErrorInfo();
            $error_flag == 1;
        }
    }


    $output["status"] = $error_flag;
    echo json_encode($output);
?>