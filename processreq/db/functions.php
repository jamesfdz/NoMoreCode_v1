<?php
	
	//function for custom empty validation
	function customNonEmpty($input){
	    if($input == ""){
	        $input = "-";
	    }
	    return $input;
	}

?>