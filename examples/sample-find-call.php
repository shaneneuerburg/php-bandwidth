<?php
require_once('../source/Catapult.php');

// below is a sample call search 
// it will look through your calls and find
// the last incoming call from a number
// IMPORTANT: edit credentials.json
// with your information
// or comment out below /w your keys
//
$cred = new Catapult\Credentials('USER_ID', 'API_TOKEN', 'API_SECRET');
//$cred = new Catapult\Credentials;
// dont forget to comment out the implicit version if using assoc array

$client = new Catapult\Client($cred);


try {
	$call = new Catapult\Call;
	$calls = $call->listCalls();

	$last = $calls->find(array("direction" => "in"))
	      ->find(array("from" => $argv[1]))
	      ->last();

	if ($last)
		printf("We've found the last call from: %s. It was at", $argv[1], $last->date);
	else
		printf("We couldnt find that call.");

} catch (\CatapultApiException $e) {
	echo var_dump($e);	
}
?>
