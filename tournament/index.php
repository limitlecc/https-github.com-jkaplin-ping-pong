<?php
	session_start();
	if (isset($_SESSION["user"]))
	{
		$guest = false;
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
				}
				else
				{
					$done = 0;
				}
			}
		}
	}
	else
	{
		$guest = true;
		$intra = "GUEST";
		$name = "GUEST";
		$img = "guest.jpg";
		$done = 0;
	}
?>


<!doctype html>

<html lang="en">

<head>
  <meta charset="utf-8">
  <title>ft_ping-pong</title>
	<link rel="shortcut icon" href="ping-pong.ico" />
  <link rel="stylesheet" href="style.css" />
	<script type="text/javascript" src="script.js"></script>
</head>

<body>
	<h1>ft_pingPong</h1>
	<br>
	<h2>
		<?php
			echo "Hi there $name";
		?>
	</h2>
	<iframe src="https://challonge.com/m5u4u1c4/module?&show_standings=1&multiplier=2" width="100%" height="70%" frameborder="0" scrolling="auto" allowtransparency="true"></iframe>
	<div class="container">  
		<form id="form" action="" method="post">
			<h3>Submit the Match Score</h3>
			<h4>Each player has to submit one form</h4>
			<fieldset>
				<input value="<?php echo $intra;?>" type="text" required autofocus readonly>
			</fieldset>
			<fieldset>
				<input placeholder="Your Score" type="number" min="0" max="21" required>
			</fieldset>
			<fieldset>
				<input value="<?php echo $op_intra;?>" type="text" required autofocus readonly>
			</fieldset>
			<fieldset>
				<input placeholder="Opponent Score" type="number" min="0" max="21" required>
			</fieldset>
			<fieldset>
				<button name="submit" type="submit" id="contact-submit" data-submit="...Sending">Submit</button>
			</fieldset>
		</form>
	</div>
	<?php if (!$guest) { ?>
		<h1>Join the Tournament</h1>
	<?php } ?>
	<script>
		window.onload = draw_win;
		window.onload = draw_lose;
		window.onload = show_form('<?php echo $intra; ?>', <?php echo $done ?>);
	</script>
</body>

</html>
