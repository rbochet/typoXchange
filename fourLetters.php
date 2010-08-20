<?php

/**
* Allow $fp to be used in getCount
*/
global $fp;

if (!($fp = fopen('fourletters.csv', 'w'))) {
    return;
}

/**
  Get the number of results  by using the google API
 */
function getCount($fp, $obj) {
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
	fprintf($fp, $obj.'; '.$json['responseData']['cursor']['estimatedResultCount']."\n");
}

/**
* Main part of the code : words generation & getCount calls
*/
$letters = array ("A","B","C","D","E","F","G","H","I","J","K","L","M",
"N","O","P","Q","R","S","T","U","V","W","X","Y","Z");

foreach ($letters as $fLetter) {
	foreach ($letters as $sLetter) {
		foreach ($letters as $tLetter) {
			foreach ($letters as $foLetter) {
				getCount($fp, $fLetter.$sLetter.$tLetter.$foLetter);
			}
		}
	}
}


?>
