<?php

 /**
* @name : NMC
* author : James Fernandes 
* @Description : received data from createproject.js and creating project in database in this file
* @Documentation page :
* @parameter 1 :
* @Old Code File & Line No.:
* @New Code File & Line No.:
* Eg.
**/


//including config and db
require_once( $_SERVER["DOCUMENT_ROOT"] . "/processreq/db/config.php" );

require_once( LIBRARY_PATH . "db.php" );

//defining global variables
$output = array();
$addedon = date("Y-m-d");
$uniqueName = date("Y_m_d_h_s_a");

//used to capture error
$error = 0;
$errorMessage = "";
$errorCode = 0;
$rollbackStatus = 0;
$rollbackMessage = "";

//data sent by ajax is capture here
$projectType = $_POST["projectType"];
$projectName = $_POST["projectName"];


//checking if data received is empty or no
if( ! $projectType){
    $error = 1;
    $errorMessage = "Project type empty";
    $errorCode = 1;
}


if( ! $projectName){
    $error = 1;
    $errorMessage = "Project name empty";
    $errorCode = 2;
}


/**
* Description : Start DB Transaction if no error
*
*/
if($error == 0){
 
    $stmtTransaction = @PDO_startTransaction();

    // if (!$stmtTransaction || ($stmtTransaction && $stmtTransaction->errorCode() != 0)) {
    if (!$stmtTransaction) {
        $error = 1;
        $errorMessage = "Issue during Transaction" ;
        $errorCode = 3;
    }
}

/**
* Description: check project name is unique or not.
*
*/
if($error == 0){

    $projectIdSQL = 'SELECT projectid FROM projects WHERE projectName = "'. $projectName .'"' ;

    $projectIdResult = PDO_FetchAll($projectIdSQL);

    if(count($projectIdResult) > 0){
        $error = 1;
        $errorMessage = "Project Name is already exist.";
        $errorCode = 4;
    }
}

/**
* Description: Creating new Entry in project table.
*
*/
if($error == 0){

    $respHtml = "&lt;div class=&quot;lyrow firstGridRow ui-draggable&quot; id=&quot;1556798499498_498_9009246&quot;&gt;
                            &lt;a href=&quot;#close&quot; class=&quot;remove btn btn-danger btn-xs&quot; id=&quot;1556798499498_498_517417&quot;&gt;&lt;i class=&quot;fa-remove fa&quot; id=&quot;1556798499498_498_9655255&quot;&gt;&lt;/i&gt;&lt;/a&gt;
                            &lt;a class=&quot;drag btn btn-default btn-xs&quot; data-toggle=&quot;tooltip&quot; title=&quot;Drag&quot; id=&quot;1556798499498_498_2464024&quot;&gt;&lt;i class=&quot;fa fa-arrows-alt&quot; id=&quot;1556798499498_498_4044963&quot;&gt;&lt;/i&gt;&lt;/a&gt;
                            &lt;a class=&quot;copy copyDiv btn btn-default btn-xs&quot; data-toggle=&quot;tooltip&quot; title=&quot;&quot; aria-describedby=&quot;ui-tooltip-5&quot; id=&quot;1556798499498_498_2802314&quot;&gt;&lt;i class=&quot;fa fa-copy&quot; id=&quot;1556798499498_498_3014885&quot;&gt;&lt;/i&gt;&lt;/a&gt;
                            &lt;a class=&quot;insertAfter btn btn-default btn-xs&quot; data-toggle=&quot;tooltip&quot; title=&quot;Insert After&quot; id=&quot;1556798499499_499_623948&quot;&gt;&lt;i class=&quot;fa fa-angle-double-down&quot; id=&quot;1556798499499_499_1622306&quot;&gt;&lt;/i&gt;&lt;/a&gt;
                            &lt;a class=&quot;plusCurrentRow btn btn-default btn-xs&quot; data-toggle=&quot;tooltip&quot; title=&quot;Add Layout&quot; id=&quot;1556798499499_499_6233726&quot;&gt;&lt;i class=&quot;fa fa-plus&quot; id=&quot;1556798499499_499_123412&quot;&gt;&lt;/i&gt;&lt;/a&gt;
                            &lt;a href=&quot;#&quot; class=&quot;btn btn-info btn-xs clone&quot; id=&quot;1556798499499_499_3922961&quot;&gt;&lt;i class=&quot;fa fa-clone&quot; id=&quot;1556798499499_499_9291558&quot;&gt;&lt;/i&gt;&lt;/a&gt;
                            &lt;a href=&quot;#&quot; class=&quot;btn btn-info btn-xs addSnippet&quot; id=&quot;1556798499499_499_7830091&quot;&gt;&lt;i class=&quot;fa fa-database&quot; id=&quot;1556798499499_499_2432556&quot;&gt;&lt;/i&gt;&lt;/a&gt;
                            &lt;div class=&quot;preview&quot; id=&quot;1556798499499_499_1945526&quot;&gt;
                                &lt;div class=&quot;row&quot; id=&quot;1556798499499_499_6721104&quot;&gt;
                                    &lt;div class=&quot;col-md-8 gridInputColPadding&quot; id=&quot;1556798499499_499_6667885&quot;&gt;
                                        &lt;input id=&quot;gridInput&quot; type=&quot;text&quot; value=&quot;&quot; class=&quot;form-control&quot;&gt;
                                    &lt;/div&gt;
                                    &lt;div class=&quot;col-md-4 gridInputColPadding&quot; id=&quot;1556798499499_499_3428170&quot;&gt;
                                        &lt;p id=&quot;gridInputCount&quot;&gt;= 600&lt;/p&gt;
                                    &lt;/div&gt;
                                &lt;/div&gt;
                            &lt;/div&gt;
                            &lt;div class=&quot;view&quot; id=&quot;1556798499499_499_774560&quot;&gt;
                                &lt;table class=&quot;row clearfix&quot; border=&quot;0&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; align=&quot;center&quot; id=&quot;mainTable&quot; style=&quot;-webkit-user-modify: read-only; -moz-user-modify: read-only;min-width:100%; min-height:100%;&quot; width=&quot;100%&quot; height=&quot;100%&quot;&gt;&lt;tbody id=&quot;1556798499499_499_1472770&quot;&gt;&lt;tr id=&quot;1556798499499_499_7457801&quot;&gt;&lt;td class=&quot;column ui-sortable ui-droppable&quot; style=&quot;padding-top: 10px;&quot; id=&quot;1556798499500_500_8127311&quot;&gt;
                        
                        
                    
                    
                        &lt;div class=&quot;lyrow firstGridRow ui-draggable&quot; id=&quot;1556812852093_93_4910090&quot;&gt;
                            &lt;a href=&quot;#close&quot; class=&quot;remove btn btn-danger btn-xs&quot; id=&quot;1556812852093_93_4919916&quot;&gt;&lt;i class=&quot;fa-remove fa&quot; id=&quot;1556812852093_93_4656533&quot;&gt;&lt;/i&gt;&lt;/a&gt;
                            &lt;a class=&quot;drag btn btn-default btn-xs&quot; data-toggle=&quot;tooltip&quot; title=&quot;Drag&quot; id=&quot;1556812852093_93_6487254&quot;&gt;&lt;i class=&quot;fa fa-arrows-alt&quot; id=&quot;1556812852093_93_2788770&quot;&gt;&lt;/i&gt;&lt;/a&gt;
                            &lt;a class=&quot;copy copyDiv btn btn-default btn-xs&quot; data-toggle=&quot;tooltip&quot; title=&quot;&quot; aria-describedby=&quot;ui-tooltip-38&quot; id=&quot;1556812852093_93_5484477&quot;&gt;&lt;i class=&quot;fa fa-copy&quot; id=&quot;1556812852093_93_4763297&quot;&gt;&lt;/i&gt;&lt;/a&gt;
                            &lt;a class=&quot;insertAfter btn btn-default btn-xs&quot; data-toggle=&quot;tooltip&quot; title=&quot;Insert After&quot; id=&quot;1556812852093_93_2763548&quot;&gt;&lt;i class=&quot;fa fa-angle-double-down&quot; id=&quot;1556812852093_93_2142648&quot;&gt;&lt;/i&gt;&lt;/a&gt;
                            &lt;a class=&quot;plusCurrentRow btn btn-default btn-xs&quot; data-toggle=&quot;tooltip&quot; title=&quot;Add Layout&quot; id=&quot;1556812852094_94_6605064&quot;&gt;&lt;i class=&quot;fa fa-plus&quot; id=&quot;1556812852094_94_6524677&quot;&gt;&lt;/i&gt;&lt;/a&gt;
                            &lt;a href=&quot;#&quot; class=&quot;btn btn-info btn-xs clone&quot; id=&quot;1556812852094_94_3224271&quot;&gt;&lt;i class=&quot;fa fa-clone&quot; id=&quot;1556812852094_94_2484164&quot;&gt;&lt;/i&gt;&lt;/a&gt;
                            &lt;a href=&quot;#&quot; class=&quot;btn btn-info btn-xs addSnippet&quot; id=&quot;1556812852094_94_3647997&quot;&gt;&lt;i class=&quot;fa fa-database&quot; id=&quot;1556812852094_94_8886149&quot;&gt;&lt;/i&gt;&lt;/a&gt;
                            &lt;div class=&quot;preview&quot; id=&quot;1556812852094_94_660756&quot;&gt;
                                &lt;div class=&quot;row&quot; id=&quot;1556812852094_94_4760522&quot;&gt;
                                    &lt;div class=&quot;col-md-8 gridInputColPadding&quot; id=&quot;1556812852094_94_7183477&quot;&gt;
                                        &lt;input id=&quot;gridInput&quot; type=&quot;text&quot; value=&quot;&quot; class=&quot;form-control&quot;&gt;
                                    &lt;/div&gt;
                                    &lt;div class=&quot;col-md-4 gridInputColPadding&quot; id=&quot;1556812852094_94_8065371&quot;&gt;
                                        &lt;p id=&quot;gridInputCount&quot;&gt;= 600&lt;/p&gt;
                                    &lt;/div&gt;
                                &lt;/div&gt;
                            &lt;/div&gt;
                            &lt;div class=&quot;view&quot; id=&quot;1556812852095_95_8155925&quot;&gt;
                                &lt;table class=&quot;device_width row clearfix&quot; border=&quot;0&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; align=&quot;center&quot; id=&quot;mainTable&quot; style=&quot;-webkit-user-modify: read-only; -moz-user-modify: read-only; margin:0 auto;&quot; width=&quot;600&quot;&gt;&lt;tbody id=&quot;1556812852095_95_5460886&quot;&gt;&lt;tr id=&quot;1556812852095_95_3665302&quot;&gt;&lt;td class=&quot; column &quot; valign=&quot;top&quot; height=&quot;10&quot; style=&quot;font-family:Arial, Helvetica, sans-serif; color:#585858;&quot; data-color=&quot;#585858&quot; data-ff=&quot;Arial, Helvetica, sans-serif&quot; data-height=&quot;10&quot; id=&quot;1556812852095_95_8856674&quot;&gt;&lt;/td&gt;&lt;/tr&gt;&lt;/tbody&gt;&lt;/table&gt;
                            &lt;/div&gt;
                        &lt;/div&gt;
                    &lt;/td&gt;&lt;/tr&gt;&lt;/tbody&gt;&lt;/table&gt;
                            &lt;/div&gt;
                        &lt;/div&gt;";
                  

    if($projectType == "veeva_responsive" || $projectType == "et_responsive"){
        $newProjectSql = 'INSERT INTO 
                      projects(projectName, projectType, active, html, addedOn)
                      values ("'.$projectName.'", "'.$projectType.'", 1, "'.$respHtml.'", "'.$addedon.'")';
    }else{
        $newProjectSql = 'INSERT INTO 
                      projects(projectName, projectType, active, addedOn)
                      values ("'.$projectName.'", "'.$projectType.'", 1, "'.$addedon.'")';
    }

    $newProjectResult = PDO_Execute($newProjectSql);
    
    
    if (!$newProjectResult || ($newProjectResult && $newProjectResult->errorCode() != 0)) {
        $error = 1;
        $errorMessage = "Something went wrong while Creating new Project." ;
        $errorCode = 5;
    } else {
        
        $projectId = @PDO_LastInsertId();

        if(! $projectId){
            $error = 1;
            $errorMessage = "Something went wrong while fetching last inserted id";
            $errorCode = 6;
        }

    }

}

/**
* Description : Committing the transaction to complete it
*
*/

if($error == 0){
        
    $stmtCommit = @PDO_commit();
    
    if (!$stmtCommit) {
        $error = 1;
        $errorMessage = "Something went wrong while commiting" ;
        $errorCode = 7;
    } else {
        $error = 0;
        $errorMessage = "Created Project Successfully" ;
        $errorCode = 0;
    }

} else {

    /**
    * Description : Rollback Transaction 
    *
    */
    $stmtRollback = @PDO_rollback();
    
    if (!$stmtRollback) {
        $rollbackStatus = 1;
        $rollbackMessage = "Error in rollback";
    } else {
        $rollbackStatus = 0;
        $rollbackMessage = "Rollbacked Successfully";
    }

}

/**
* Description : Output data
*
*/  
$output["projectId"] = $projectId;
$output["projectType"] = $projectType;
$output["projectName"] = $projectName;
// $output["html"] = $respHtml;
$output["error"] = $error;
$output["errorCode"] = $errorCode;
$output["errorMessage"] = $errorMessage;
$output["rollbackStatus"] = $rollbackStatus;
$output["rollbackMessage"] = $rollbackMessage;
echo json_encode($output);

?>