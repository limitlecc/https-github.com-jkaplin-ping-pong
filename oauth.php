<?php

	session_start();
	$code = $_GET["code"];

	exec("curl -F grant_type=authorization_code \
			-F client_id=bca228b966922e62a5acf60e899a861b4b99d863a0a6f8c1e7401a23448f7983 \
			-F client_secret=9f01ac217366138e54dd6e44168ee088fc5e5cdd9f949126967f59e87d27a3aa \
			-F code=$code \
			-F redirect_uri=https://chess-matches.herokuapp.com/oauth.php \
			-X POST https://api.intra.42.fr/oauth/token",$arr);
	$obj = json_decode($arr[0]);
	$access_token = $obj->access_token;
	exec("curl -H 'Authorization: Bearer $access_token' 'https://api.intra.42.fr/v2/me'", $out);
	$obj = json_decode($out[0]);
	$_SESSION["user"] = $obj;
	var_dump($obj->email);
	var_dump($obj->login);
	var_dump($obj->first_name);
	var_dump($obj->last_name);
	header('Location: https://ft-chess.herokuapp.com/tournament');
?>
