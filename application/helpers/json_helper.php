<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

function json_response($status = false, $message = false){
	
	$array = array(
					"status" => $status,
					"message" => $message
				  );

	$json = json_encode($array);
	echo $json;  
	die();
}