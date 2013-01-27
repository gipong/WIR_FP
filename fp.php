<?php
	header ('Content-Type: text/html; charset=UTF-8');
	header("Access-Control-Allow-Origin: localhost");
	require('simple_html_dom.php');

	//$html = file_get_contents('http://www.cwb.gov.tw/V7/observe/rainfall/ha_100.htm');
	//preg_match_all('/<table class="BoxTable" style="width:80%">(.*)<\/table>/s', $html, $matches);
	
	$html_L = file_get_html('http://www.cwb.gov.tw/V7/observe/rainfall/ha_100.htm');
	$result = $html_L->find('table.BoxTable tbody tr');
	
	$data = array();
	foreach ($result as $tr => $th) {
		if($tr == 0)
			continue;
		if(!isset($data[$tr]))
			$data[$tr] = array();
		foreach($th->find('td') as $value) {
			array_push($data[$tr], $value->plaintext);
		}		
	}
	
	$jsonData=json_encode($data, JSON_UNESCAPED_UNICODE); 
	echo $jsonData;

?>