
<?php
	include_once("api.php");
	if (isset($_POST["submit"]) && $_POST["submit"] === "OK")
	{
		$intra_name = $_POST["p1"];
		$score = $_POST["p1_score"];
		$op_score = $_POST["p2_score"];
		updateMatchScore($intra_name, $score, $op_score);
	}
	header("Location: https://chess-matches.herokuapp.com/");
	exit;
?>
