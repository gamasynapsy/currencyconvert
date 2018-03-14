<?php
/* File : rest.php
	 * Author : Gama Toko
	*/
/*******************************************************

    This program is free software; you can redistribute it and/or modify
    it as u need.
    * REST API
******************************************************/ 

require 'converter.php';
require 'db.php';

		$curr=$_GET['currency'];
		$amount=$_GET['amount'];
		$operation=$_GET['op'];
		
		// checking rate from the currency through database with function below
		$rate=give_rates($curr);
		
		// Initiate Api according to the type of operation needed - (Reverse/Convert)
		$api = new Converter($rate,$amount);
		
		if($operation=='convert')
			$output=$api->convert();
		else
			$output=$api->reverse();
		
		//Return result
		if(!empty($output))
			response(200,"Conversion Done",$output);
		else
			response(400,"Invalid Request",NULL);
		
		
		
		/**
			CURRENCY Rates as found in Maviance coding challenge doc..dont have time to check rates in the web
			* can use this --->
	The application shall use the valid ECB exchange rate for the current day taken from:
o Docs: http://www.ecb.int/stats/exchange/eurofxref/html/index.en.html#dev
o Request: http://www.ecb.int/stats/eurofxref/eurofxref-daily.xml

		**/ 
				
		function give_rates($curr){
		/**
			get method currency from db file to access database rates
		*/	
			$rate=getcurrency();
			if(!empty($rate)){
				return $rate;
				break;
			}
			
		}
		
		
	/**
		 *	Encode array into JSON
		*/
		function json($data){
			if(is_array($data)){
				return json_encode($data);
			}
		}
		
		function response($status,$status_message,$data){
			header("HTTP/1.1 ".$status);
			
			$response['status']=$status;
			$response['status_message']=$status_message;
			$response['data']=$data;
			
			$json_response = json($response);
			echo $json_response;
		}
?>
