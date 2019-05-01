
<?php
	echo $_POST["submit"];
	if (isset($_POST["submit"]) && $_POST["submit"] === "OK")
	{
		echo "IN";
		$submitted = 1;
		$intra_name = $_POST["p1"];
		$score = $_POST["p1_score"];
		$op_score = $_POST["p2_score"];
		updateMatchScore($intra_name, $score, $op_score);
	}
	//header("Location: http://ft-ping-pong.herokuapp.com/tournament/");
	//exit;
?>
