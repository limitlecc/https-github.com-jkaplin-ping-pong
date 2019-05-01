<?php
	session_start();
	include("api.php");

	if (isset($_SESSION["user"]))
	{
		$guest = 0;
		$user = $_SESSION['user'];
		$intra = $user->login;
		$name = $user->displayname;
		$img = $user->image_url;


		$csv = array_map('str_getcsv', file('data.csv'));
		for ($i = 1; $i < count($csv); $i++)
		{
			if ($csv[$i][0] === $intra)
			{
				$op_intra = $csv[$i][2];
				if ($csv[$i][4] === "1")
				{
					$done = 1;
					break;
				}
				else
				{
					$done = 0;
				}
			}
			else {
				$done = 0;
			}
		}
	}
	else
	{
		$guest = 1;
		$intra = "";
		$name = "";
		$img = "guest.jpg";
		$done = 0;
	}
	$participants = getParticipants();
	$participant = 0;


	
	if (isset($_POST["submit"] && $_POST["submit"] === "OK"))
	{
		$intra_name = $_POST["p1"];
		$score = $_POST["p1_score"];
		$op_score = $_POST["p2_score"];
		updateMatchScore($intra_name, $score, $op_score);
	}

?>


<!doctype html>

<html lang="en">

<head>
  <meta charset="utf-8">
  <title>ft_ping-pong</title>
	<link rel="shortcut icon" href="ping-pong.ico" />
  <link rel="stylesheet" href="tournament.css" />
	<script type="text/javascript" src="script.js"></script>
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

	<ol id="participants">
		<u>Tournament Participants</u>
		<?php for($i = 0; $i < count($participants); $i++) { ?>
			<li>
				<?php echo $participants[$i]; ?>
				<?php
					if ($participants[$i] == $intra)
						$participant = 1;
				?>
			</li>
		<?php } ?>
	</ol>

	<form action="http://ft-ping-pong.herokuapp.com/tournament/" method="post">
		<button id="enter">Enter The Tournament</button>
	</form>

<!--	<iframe src="https://challonge.com/m5u4u1c4/module?multiplier=2" width="100%" height="70%" frameborder="0" scrolling="auto" allowtransparency="true"></iframe> -->
	<div class="container">  
		<form id="form" action="http://ft-ping-pong.herokuapp.com/tournament/" method="post">
			<h3>Submit the Match Score</h3>
			<h4>Each player has to submit one form</h4>
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
		let guest = <?php echo $guest; ?>;
		let done = <?php echo $done; ?>;
		let participant = <?php echo $participant ?>;

		if (!guest && !participant)
		{
			document.getElementById("enter").style.display = "block";
		}
		if (!guest && done)
		{
			document.querySelector(".container").style.display = "block";
		}

		document.getElementById('enter').addEventListener('click', function() {
			<?php
				if (!$guest && !$participant)
					addParticipant($intra, $img);
			?>
		});
	</script>
</body>

</html>
