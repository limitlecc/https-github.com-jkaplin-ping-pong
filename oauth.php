<?php
	echo $_GET["code"];
	$code = $_GET["code"];

	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, 'https://api.intra.42.fr/oauth/token');
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, "client_id=511d20aaebf083f243087bc461886b5d79bd862e029d400e9870fa7d1982c6b6&redirect_uri=https://jkaplin.github.io/ping-pong/tournament&grant_type=authorization_code&code=$code");

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

	$result = curl_exec($ch);
	if (curl_errno($ch)) {
			echo 'Error:' . curl_error($ch);
	}

	var_dump($result);
?>
