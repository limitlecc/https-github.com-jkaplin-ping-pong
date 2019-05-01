<?php
	session_start();
	include_once("api.php");

	if (isset($_SESSION["user"]))
	{
		$guest = 0;
		$user = $_SESSION['user'];
		$intra = $user->login;
		$name = $user->displayname;
		$img = $user->image_url;
		$op_intra = getOpponent($intra);
		if ($op_intra)
			$open = true;
		else
			$open = false;
	}
	else
	{
		$guest = 1;
		$intra = "";
		$name = "";
		$img = "guest.jpg";
		$open = 0;
		$op_intra = "jkaplin";
	}
	$participants = getParticipants();
	$participant = 0;


	
	if (isset($_POST["submit"]) && $_POST["submit"] === "OK")
	{
		$intra_name = $_POST["p1"];
		$score = $_POST["p1_score"];
		$op_score = $_POST["p2_score"];
		updateMatchScore($intra_name, $score, $op_score);
		header("refresh: 0");
	}

?>


<!doctype html>

<html lang="en">

<head>
  <meta charset="utf-8">
  <title>ft_ping-pong</title>
  <link href="https://assets.challonge.com/favicon-16x16.png" rel="icon" sizes="16x16" type="image/png">
  <link rel="stylesheet" href="tournament.css" />
</head>

<body>
	<h1>ft_ping-pong</h1>
	<br>
	<h2>
		<?php
			echo "Hello $name!";
		?>
			<br>
			<br>
		<?php
			echo "- Welcome to the club (:";
		?>
	</h2>

	<div id="participants">
	<div id="number"></div>
		<u>Tournament Participants</u>
		<br>
		<div id="count">
			<?php for($i = 0; $i < count($participants); $i++) { ?>
				<div>
					<br>
					<?php echo $participants[$i]; ?>
					<?php
						if ($participants[$i] == $intra)
							$participant = 1;
					?>
				</div>
			<?php } ?>
		</div>
	</div>

	<form action="http://ft-ping-pong.herokuapp.com/tournament/" method="post">
		<button id="enter">Enter The Tournament</button>
	</form>

<!--	<iframe src="https://challonge.com/m5u4u1c4/module?multiplier=2" width="100%" height="70%" frameborder="0" scrolling="auto" allowtransparency="true"></iframe> -->
	<div class="container">  
		<form id="form" action="" method="post">
			<h3>Submit the Match Score</h3>
			<fieldset>
				<input name="p1" value="<?php echo $intra;?>" type="text" required autofocus readonly>
			</fieldset>
			<fieldset>
				<input name="p1_score" placeholder="Your Score" type="number" min="0" max="21" required>
			</fieldset>
			<fieldset>
				<input name="p2" value="<?php echo $op_intra;?>" type="text" required autofocus readonly>
			</fieldset>
			<fieldset>
				<input name="p2_score" placeholder="Opponent Score" type="number" min="0" max="21" required>
			</fieldset>
			<fieldset>
				<button name="submit" value="OK" type="submit" id="contact-submit" data-submit="...Sending">Submit</button>
			</fieldset>
		</form>
	</div>
	<script>
		function begin() {
			let num = document.getElementById("count").children.length;
			document.getElementById("number").innerHTML = num;

			let guest = <?php echo $guest; ?>;
			let open = '<?php echo $open; ?>';
			let participant = <?php echo $participant ?>;

			if (!guest && !participant)
			{
				document.getElementById("enter").style.display = "block";
			}
			if (!guest && open)
			{
				document.querySelector(".container").style.display = "block";
			}
		};

		document.onload = begin();
		document.getElementById('enter').addEventListener('click', function() {
			<?php
				if (!$guest && !$participant)
					addParticipant($intra);
			?>
		});

		document.getElementById('form').addEventListener('submit', function() {
			document.querySelector(".container").style.display = "none";
		});
	</script>
</body>

</html>
