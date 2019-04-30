<?php

include('challonge.class.php');

$c = new ChallongeAPI("fKYhLuDW5EbWKhLgSsgGaRRar6qbNMuwrbGxyCJS");

$c->verify_ssl = false;

$tournament_id = 5931277;

function getParticipants()
{
	$c = $GLOBALS['c'];
	$tournament_id = $GLOBALS['tournament_id'];	
	$participants = $c->getParticipants($tournament_id);

	$p_arr = [];

	for ($i = 0; $i < count($participants->participant); $i++)
	{
		$p_arr[] = $participants->participant[$i]->name;
	}
	return ($p_arr);
}


?>
