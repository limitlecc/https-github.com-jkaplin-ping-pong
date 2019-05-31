<?php
	include_once("api.php");

	if (isset($_POST["enter"]))
	{
		$intra = $_POST["enter"];
		addParticipant($intra);
	}

	header("Location: http://chess-matches.herokuapp.com/tournament/");
	exit;
?>
