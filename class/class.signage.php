<?php

ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);

class Signage {
	
	//Function for getting Tube Status as HTML
	public function TubeStatus(){
		
		//Initalise HTML response
		$html = '';
		
		//Load tube status data
		$xml = @simplexml_load_file('http://cloud.tfl.gov.uk/TrackerNet/LineStatus');
		
		if($xml){
		
			$tubes = array();
			
			//Push tube names, colours and statuses into an array
			foreach($xml->LineStatus as $line){
				$tubes[] = array(
					"name" => $line->Line['Name'],
					"class" => strtolower(preg_replace("/[^A-Za-z0-9]/", "", $line->Line['Name'])),
					"status" => $line->Status['Description'],
					"details" => $line['StatusDetails']
				);
			}
			
			//Return array in HTML format
			foreach($tubes as $tube){
				
				$name		= $tube['name'];
				$class		= $tube['class'];
				$status		= $tube['status'];
				$details	= (string)$tube['details'];
				$bold		= (!empty($details)) ? "style=\"font-weight:bold; color:red;\"": "";
				
				$html.= "		<div class=\"$class tube-animate\">";
				$html.= "			<div class=\"tube-badge\">";
				$html.= "				<p>$name</p>";
				$html.= "			</div>";
				$html.= "			<div class=\"tube-info\">";
				$html.= "				<p $bold alt=\"$details\" title=\"$details\">$status</p>";
				$html.= "			</div>";
				$html.= "		</div>";
				
			}
			
		}
		
		//IF API is down, return pretty error
		else {
		
			$html.= "		<div class=\"tube-error tube-animate\">";
			$html.= "			<div class=\"tube-badge\">";
			$html.= "				<p>Failed</p>";
			$html.= "			</div>";
			$html.= "			<div class=\"tube-info\">";
			$html.= "				<p>Tube API is down.</p>";
			$html.= "			</div>";
			$html.= "		</div>";
			
		}
		
		return $html;
	}
		
}
?>