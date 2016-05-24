<?php
//api call
require_once('api.php');


function init() {
	getRecord('6160739');
	getRecord('6094817');
}

function parseJSON($file) {
	$timestamp = time();
	$json = $file;
	$jfo = json_decode($json);
	$jfo->time['timestamp'] = $timestamp;
	$jfo->time['datetime'] = date('Y-m-d H:i:s', $timestamp);
	return $jfo;
}

function getRecord($cityId){
	if(file_exists('data/'.$cityId)){
		$records = scandir('data/'.$cityId.'/');
		$matches = [];

		foreach($records as $record){
			if(strpos($record, '.json')){
				$matches[] = $record;
			}
		}
		if (!empty($matches)){
			// if file exists see how old it is
			foreach ($matches as $match){
				//vars
				$path = 'data/'.$cityId.'/'.$match;
				$fileAge = filemtime($path);
				$cutoff = (time() - 600);
				$filetype = pathinfo($match);

				if ($filetype['extension'] == 'json'){
					print_r('json');
					if($fileAge - $cutoff > 0){
						//get existing match
						var_dump('old', $fileAge - $cutoff);


					} else {
						var_dump('new');
						$clear = unlink($path);

						if($clear == true){
							data_create($cityId,'daily');
						} else {
							print_r('error');
						}
						
					}
				}
			}
			
		} else {
			data_create($cityId,'daily');
		}

	} else{
		data_create($cityId,'daily');
	}
}
function error_posting() {

}