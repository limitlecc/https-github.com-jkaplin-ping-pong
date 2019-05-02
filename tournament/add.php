<?php
	include_once("api.php");

	if (isset($_POST["enter"]))
	{
		$intra = $_POST["enter"];
		addParticipant($intra);
	}

	header("Location: http://ft-ping-pong.herokuapp.com/tournament/");
	exit;
?>
