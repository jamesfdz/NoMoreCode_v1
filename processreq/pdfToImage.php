<?php 
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
            	$ext = pathinfo($filename, PATHINFO_EXTENSION);
            }
        }
    }
    return $name;
}

$output["data"] = list_files("../processreq/java/");
$output["success"] = 1;
echo json_encode($output);

?>