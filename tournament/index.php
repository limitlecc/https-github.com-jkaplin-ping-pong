<?php
	session_start();
	if (isset($_SESSION["user"]))
	{
		$guest = false;
		$user = $_SESSION['user'];
		$intra = $user->login;
		$name = $user->displayname;
		$img = $user->image_url;
	}
	else
	{
		$guest = true;
		$intra = "GUEST";
		$name = "GUEST";
		$img = "guest.jpg";
	}
?>


<!doctype html>

<html lang="en">

<head>
  <meta charset="utf-8">
  <title>ft_ping-pong</title>
	<link rel="shortcut icon" href="ping-pong.ico" />
  <link rel="stylesheet" href="style.css" />
	<script type="text/javascript" src="tournament/script.js"></script>
</head>

<body>
	<h1>
		<?php
			echo "Hi there $name";
		?>
	</h1>
	<div class="container">  
    	<form id="form" action="" method="post">
			<h3>Submit the Match Score</h3>
			<h4>Each player has to submit one form</h4>
			<fieldset>
				<input placeholder="Your Intra" type="text" required autofocus>
			</fieldset>
			<fieldset>
				<input placeholder="Your Score" type="number" min="0" max="21" required>
			</fieldset>
			<fieldset>
				<input placeholder="Opponent Intra" type="text" required>
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
	</script>
</body>

</html>
