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

    //setting indian time as default time 
    date_default_timezone_set('Asia/Calcutta');
    
    $output = array();
    $hostname = "..";

	$html_code = htmlspecialchars_decode($_POST["htmlContent"]);
    if($html_code){
        $temp_html_code = $html_code;

        //array of data which need to replace
        $ascii_char_array = ["&#00038;", "&#00045;", "&#00174;", "&#00169;", "&#00034;", "&#08482;", "&#08804;", "&#08805;", "&#00060;", "&#00062;", "&#00042;", "&#08226;", "&#00239;", "&#08211;", "&#08217;", "&#00177;", "&#08212;", "&#00126;", "&#08213;", "&#08224;", "&#08225;", "&#00167;", "&#00039;"];

        //array of data which need to be replace by this
        $ascii_class_array = ['___&___', '___-___', '___®___', '___©___', '___"___', '___™___', '___≤___', '___≥___', '___<___', '___>___', '___\___', '___•___', '___ï___', '___–___', '___’___', '___±___', '___—___', '___~___', '___―___', '___†___', '___‡___', '___§___', "___'___"];

        $temp_html_code = str_replace($ascii_class_array, $ascii_char_array, $temp_html_code);
        $html_code = $temp_html_code;
    }

    // echo $html_code;exit();
    $totalImage = $_POST["totalImage"];

	$myfile = fopen("../output/index.html", "w");
	$files = "../output/index.html";
	fwrite($myfile, $html_code);
	fclose($myfile);
// var_dump($totalImage);exit;
    if($totalImage){

        $image_path = $hostname."/images/";
        $new_image_path = $hostname."/output/images/";

        //clearing all images before copy new images folder
        $files = glob($hostname.'/output/images/*'); // get all file names
        foreach($files as $file){ // iterate files
          if(is_file($file))
            unlink($file); // delete file
        }
        
        for($i=0 ; $i < count($totalImage) ; $i++) {
            if (file_exists($image_path.$totalImage[$i])){
                if (@copy($image_path.$totalImage[$i], $new_image_path.$totalImage[$i])){
                    // echo $new_image_path.$totalImage[$i]." <br>";
                }
            } 
            else{
                $output["status"] = 0;
            }
        }
    }

    $output["status"] = 1;
    echo json_encode($output);


?>