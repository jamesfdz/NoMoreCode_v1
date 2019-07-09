<?php

/**
* @name : deleteDataFromDb
* author : James Fernandes 
* @Description : delete the html data to DB against respective project id on click of clearpage button
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
$modifiedOn = date("Y-m-d");
$output = array();

//used to capture error
$error = 0;
$errorMessage = "";
$errorCode = 0;
$rollbackStatus = 0;
$rollbackMessage = "";

//data sent by ajax is capture here
$htmlToSave = $_POST["htmlToSave"];
$htmlToSave = htmlspecialchars($htmlToSave);

//data getting from url
$projectId = $_GET["_projectId"];

//checking if data received is empty or no
if( ! $projectId){
    $error = 1;
    $errorMessage = "Project id is not defined";
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
* Description : saving html data in db against the project id
*
*/

if($error == 0){

	$updateSQL = 'UPDATE projects
					SET html = "'.$htmlToSave.'", modifiedOn = "'.$modifiedOn.'"
					WHERE projectid = "'.$projectId.'"';

	$updateSQLResult = PDO_Execute($updateSQL);

	if (!$updateSQLResult) {
        $error = 1;
        $errorMessage = "Something went wrong while updating project.";
        $errorCode = 4;
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
        $errorCode = 5;
    } else {
        $error = 0;
        $errorMessage = "Project Deleted Successfully" ;
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
$output["error"] = $error;
$output["errorCode"] = $errorCode;
$output["errorMessage"] = $errorMessage;
$output["rollbackStatus"] = $rollbackStatus;
$output["rollbackMessage"] = $rollbackMessage;

echo json_encode($output);

?>