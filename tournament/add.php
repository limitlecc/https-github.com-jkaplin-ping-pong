<?php
	include_once("api.php");

	if (isset($_POST["enter"]))
	{
		$intra = $_POST["enter"];
		addParticipant($intra);
	}

	header("Location: http://ft-chess.herokuapp.com/tournament/");
	exit;
?>
