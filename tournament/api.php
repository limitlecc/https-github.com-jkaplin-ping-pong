<?php

include('challonge.class.php');

$c = new ChallongeAPI("fKYhLuDW5EbWKhLgSsgGaRRar6qbNMuwrbGxyCJS");

$c->verify_ssl = false;

$tournament_id = 5931277;

function addParticipant($intra)
{
	$c = $GLOBALS['c'];
	$tournament_id = $GLOBALS['tournament_id'];	

	$params = array(
  	"participant[name]" => $intra
	);
	$participant = $c->createParticipant($tournament_id, $params);
}

function getParticipants()
{
	$c = $GLOBALS['c'];
	$tournament_id = $GLOBALS['tournament_id'];	

	$participants = $c->getParticipants($tournament_id);

	$arr = [];

	for ($i = 0; $i < count($participants->participant); $i++)
	{
		$arr[] = $participants->participant[$i]->name;
	}
	return ($arr);
}

function getNames()
{
	$c = $GLOBALS['c'];
	$tournament_id = $GLOBALS['tournament_id'];	

	$participants = $c->getParticipants($tournament_id);

	$arr = [];

	for ($i = 0; $i < count($participants->participant); $i++)
	{
		$arr[] = $participants->participant[$i]->{"display-name-with-invitation-email-address"};
	}
	return ($arr);
}

function getImages()
{
	$c = $GLOBALS['c'];
	$tournament_id = $GLOBALS['tournament_id'];	

	$participants = $c->getParticipants($tournament_id);

	$arr = [];

	for ($i = 0; $i < count($participants->participant); $i++)
	{
		$arr[] = $participants->participant[$i]->icon;
	}
	return ($arr);
}

function getParticipantId($intra)
{
	$c = $GLOBALS['c'];
	$tournament_id = $GLOBALS['tournament_id'];	

	$participants = $c->getParticipants($tournament_id);

	for ($i = 0; $i < count($participants->participant); $i++)
	{
		if ($participants->participant[$i]->name == $intra)
			return $participants->participant[$i]->id;
	}
	return (NULL);
}

function getParticipantName($id)
{
	$c = $GLOBALS['c'];
	$tournament_id = $GLOBALS['tournament_id'];	

	$participants = $c->getParticipants($tournament_id);

	for ($i = 0; $i < count($participants->participant); $i++)
	{
		if (strval($participants->participant[$i]->id) == strval($id))
			return $participants->participant[$i]->name;
	}
	return (NULL);
}

function getMatch($intra)
{
	$c = $GLOBALS['c'];
	$tournament_id = $GLOBALS['tournament_id'];	

	$id = getParticipantId($intra);

	$params = array(
	);

	$matches = $c->getMatches($tournament_id, $params);

	for ($i = 0; $i < count($matches->match); $i++)
	{
		if ($matches->match[$i]->state == "open" && (strval($matches->match[$i]->{"player1-id"}) == strval($id) || strval($matches->match[$i]->{"player2-id"}) == strval($id)))
			return($matches->match[$i]->id);
	}
}

function getOpponent($intra)
{
	$c = $GLOBALS['c'];
	$tournament_id = $GLOBALS['tournament_id'];	

	$id = getParticipantId($intra);

	$match_id = getMatch($intra);
	$match = $c->getMatch($tournament_id, $match_id);

	$p1 = $match->{"player1-id"};
	$p2 = $match->{"player2-id"};
	if (strval($id) == strval($p1))
	{
		return (getParticipantName($p2));
	}
	else
	{
		return (getParticipantName($p1));
	}
}

function updateMatchScore($intra, $score, $op_score)
{
	$c = $GLOBALS['c'];
	$tournament_id = $GLOBALS['tournament_id'];	

	$id = getParticipantId($intra);

	$match_id = getMatch($intra);
	$match = $c->getMatch($tournament_id, $match_id);

	$p1 = $match->{"player1-id"};
	$p2 = $match->{"player2-id"};
	if (strval($id) == strval($p1))
	{
		$p1_score = $score;
		$p2_score = $op_score;
	}
	else
	{
		$p1_score = $op_score;
		$p2_score = $score;
	}

	if (intval($p1_score) > intval($p2_score))
	{
		$winner = $p1;
	}
	else
	{
		$winner = $p2;
	}

	$params = array(
		"match[scores_csv]" => strval($p1_score)."-".strval($p2_score),
		"match[winner_id]" => intval($winner),
		"match[state]" => "complete"
	);
	$match = $c->updateMatch($tournament_id, $match_id, $params);
}

?>
