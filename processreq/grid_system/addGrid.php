<?php
    /**
    * Tool Name: Nomorecode
    * Created Date: September 2018
    * Filename: addGrid.php
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
    $html_code = $_POST["htmlOutput"];
	$value = $_POST["value"];


    if($html_code == "" &&  $value == ""){
        $error_flag = 1;
        $output["status"] = $error_flag;
        echo json_encode($output);
        exit;
    }
    
    // $html_code = str_replace('"',"&#34;", $html_code);
    
    $currentTime = date('m_d_Y_h_i_a');

    if($error_flag == 0){

        $data = PDO_FetchAll("SELECT id from grids where value = '".$value."'");
        if(!empty($data)){
            $error_flag = 1;
            $output["status"] = $error_flag;
            $output["id"] = $id;
            echo json_encode($output);
            exit;
        }else{
            $error_flag == 1;
        }

        $query = "INSERT INTO grids( html_code, value ) VALUES ( '".$html_code."', '".$value."')";
        $query = trim($query);  

        $stmt = @PDO_Execute($query);
        if (!$stmt || ($stmt && $stmt->errorCode() != 0)) {
            // $error = PDO_ErrorInfo();
            $error_flag == 1;
            
        }else{
            if($error_flag == 0){

                $data = PDO_FetchAll("SELECT last_insert_rowid()");

                if(!empty($data)){
                    $id = $data[0]['last_insert_rowid()'];
                }else{
                    $error_flag == 1;
                }
            }
        }
    }

    $output["status"] = $error_flag;
    $output["id"] = $id;
    echo json_encode($output);
?>