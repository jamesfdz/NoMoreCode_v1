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

    function list_files($dir)
    {
        if(is_dir($dir))
        {
            if($handle = opendir($dir))
            {
                chdir($dir);
                array_multisort(array_map('filemtime', ($files = glob("*.*"))), SORT_DESC, $files);
                foreach($files as $filename)
                {
                    $name[] = $filename;
                }
            }
        }
        return $name;
    }

    $output["data"] = list_files("../images/");
    $output["success"] = 1;
    echo json_encode($output);
?>