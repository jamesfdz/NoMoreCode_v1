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
    $output["status"] = 0;
    $i = 0;

    array_multisort(array_map('filemtime', ($files = glob("*.*"))), SORT_DESC, $files);
    foreach($files as $filename)
    {
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if($ext == "png")
        {
            $name[$i] = "../processreq/".$filename;
            $i++;
        }
    }
    
    $dir = "../images/" ;

    if(is_dir($dir))
    {
        if($handle = opendir($dir))
        {
            chdir($dir);
            array_multisort(array_map('filemtime', ($files = glob("*.*"))), SORT_DESC, $files);
            foreach($files as $filename)
            {
                $name[$i] = "../images/".$filename;
                $i++;
            }
        }
    }


    $output["data"] = $name; 
    echo json_encode($output);
?>