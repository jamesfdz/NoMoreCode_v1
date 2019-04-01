<?php
    /**
    * Tool Name: Nomorecode
    * Created Date: September 2018
    * Filename: saveOutput.php
    * Description: save ouput to zip format
    *
    */

    //notice will ignore to avoid wrong json data issue
    error_reporting(E_ALL & ~E_NOTICE);

    //setting indian time as default time 
    date_default_timezone_set('Asia/Calcutta');

    //creating emtpy array for output
    $output = array();
    $hostname = "..";
    $currentTime = date('m_d_Y_h_i_a');

    //getting post data
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

    
	// $html_code = $_POST["htmlContent"];

    // $html_code = str_replace("ZZZZ","", $html_code);

    $totalImage = $_POST["totalImage"];

	$name = $_POST["name"];
    if($name == "")
    {
        $name = "email";
    }


	$myfile = fopen("../output/index.html", "w");
	$files = "../output/index.html";
	fwrite($myfile, $html_code);
	fclose($myfile);

    $zip = new ZipArchive;
    

    if($totalImage)
    {
        // echo "if";
        $image_path = $hostname."/images/";
        $new_image_path = $hostname."/output/images/";


        //clearing all images before copy new images folder
        // get all file names
        $files = glob($hostname.'/output/images/*'); 
        // iterate files
        foreach($files as $file)
        { 
            if(is_file($file))
            {
                // delete file
                @unlink($file); 
            }
        }

        // for($i=0 ; $i < count($totalImage) ; $i++) {
        //     if (file_exists($image_path.$totalImage[$i])){
        //         if (@copy($image_path.$totalImage[$i], $new_image_path.$totalImage[$i])){
        //         }
        //     } 
        // }
        
        for($i=0 ; $i < count($totalImage) ; $i++)
        {
            if ($zip->open($hostname.'/projects/'.$name."_".$currentTime.'.zip', ZipArchive::CREATE) === TRUE)
            {
                $zip->addFile($hostname."/output/index.html", "index.html");

                // echo("image path is " + $image_path.$totalImage[$i]));

                if (file_exists($image_path.$totalImage[$i]))
                {
                    if (copy($image_path.$totalImage[$i], $new_image_path.$totalImage[$i]))
                    {
    	            	$zip->addFile($image_path.$totalImage[$i], 'images/'.$totalImage[$i]);
    	            }
    	        } 
            }
            else
            {
                $output["status"] = 0;
            }
            $zip->close();
        }
    }
    else
    {
        // echo "else";
        if ($zip->open($hostname.'/projects/'.$name."_".$currentTime.'.zip', ZipArchive::CREATE) === TRUE)
        {
            $zip->addFile($hostname."/output/index.html", "index.html");
        }
        else
        {
            $output["status"] = 0;
        }
        $zip->close();
    }

    $output["status"] = 1;
    $output["url"] = $hostname.'/projects/'.$name."_".$currentTime.'.zip';
    $output["filename"] = $name."_".$currentTime.'.zip';
    echo json_encode($output);
?>