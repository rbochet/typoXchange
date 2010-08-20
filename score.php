<?php

/**
  Get the number of results  by using the google API
 */
function getCount($obj) {
	$url = "http://ajax.googleapis.com/ajax/services/search/web?v=1.0&q=".$obj;
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_REFERER, 'http://blog.Stackr.fr');
	$body = curl_exec($ch);
	curl_close($ch);

	// Decode the JSON string to an associative array
	$json = json_decode($body, true);

	// Fetch the number of results
	echo $obj.' '.$json['responseData']['cursor']['estimatedResultCount']."\n";
}

$vowels = array('a', 'e', 'i', 'o', 'u', 'y');

foreach ($vowels as $iVowel) {
	foreach ($vowels as $aVowel) {
		getCount($iVowel.'p'.$aVowel.'d');
	}
}

?>