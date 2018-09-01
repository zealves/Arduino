<?php
if(isset($_GET['temp']) && intval($_GET['temp'])) {
	$temp = intval($_GET['temp']); 
	if(isset($_GET['formato']))
		$formato = strtolower($_GET['formato']) == 'json' ? 'json' : 'xml'; //por defeito xml
	else
		$formato = 'xml';
	
	$filename = "temperaturas.txt";	
	if (!file_exists($filename))
		$file = fopen("temperaturas.txt", "w");

	
	// Open the file to get existing content
	$current = file_get_contents($filename);
	$current .= $temp . "\n";
	// Write the contents back to the file
	file_put_contents($filename, $current);	
	
	$resultado = "recebido";

	if($formato == 'json') {
		header('Content-type: application/json');
		echo json_encode($resultado);
	} else {
		header('Content-Type: application/xml; charset=utf-8');
		$xml_res = '<?xml version="1.0" encoding="UTF-8"?>'."\n".'<resultado>'.$resultado.'</resultado>';
		echo $xml_res;
	}	

}
?>