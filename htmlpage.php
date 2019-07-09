<?php

//including config and db
require_once( $_SERVER["DOCUMENT_ROOT"] . "/processreq/db/config.php" );

require_once( LIBRARY_PATH . "db.php" );

//used to capture error
$error = 0;
$errorMessage = "";
$errorCode = 0;

$projectId = $_GET["_projectId"];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=windows-1252"/>
        <link rel="stylesheet" href="assets/css/lib/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="assets/css/htmlpage.css" />
        <title>

        </title>
    </head>
    <body bgcolor="#ffffff">
        <?php
            $sqlProject = 'SELECT * FROM projects WHERE projectid='.$projectId.'';

            $sqlProjectResult = PDO_FetchAll($sqlProject);

            if($sqlProjectResult != ""){
                $html = $sqlProjectResult[0]["html"];
            
        ?>
        <div class="htmlpage hightlight-dashed" id="htmlpage">
            <?php echo htmlspecialchars_decode($html) ?>
            <style>
                @media screen and (max-width: 736px), print and (max-width: 320px){
                    .device_width {
                        width: 100%!important;
                    }
                }
            </style>
        </div>
        <?php
            }
        ?>
    </body>
</html>
