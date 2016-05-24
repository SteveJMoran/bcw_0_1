<?php
function api() {
	$api_config = array(
		'id' => 'd7ba88cf3ed8a5e0ef3ae4e0e5a1cdba',
		'location' => 'http://api.openweathermap.org/data/2.5/forecast/'
		);
}

function api_get($time,$cityId,$units) {
	$appId = 'd7ba88cf3ed8a5e0ef3ae4e0e5a1cdba';
	$units = $units ?: 'metric';
	$time = $time ?: 'daily';
	//$cityId = $cityId ?: return;
	$api_record = file_get_contents('http://api.openweathermap.org/data/2.5/forecast/'.$time.'?id='.$cityId.'&units='.$units.'&APPID='.$appId);
	return $api_record;
}

function data_create($cityId, $timeline) {
	//if city doesn't exist, create directory
	if (!file_exists('data/'.$cityId)) {
	    mkdir('data/'.$cityId, 0777, true);
	} else {
		error_log('error creating file');
	}

	//vars
	$timeline = $timeline ?: 'daily';
	$file = 'data/'.$cityId.'/'.$timeline.'.json';
	$timestamp = time();
	//json
	$api_data = api_get($timeline,$cityId,'metric');
	//write file
	$fp = fopen($file, 'w');
	fwrite($fp, $api_data);
	fclose($fp);
}



