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
  <link rel="stylesheet" href="tournament/style.css" />
	<script type="text/javascript" src="tournament/script.js"></script>
</head>

<body>
	<h1>
		<?php
			echo "Hi there $name";
		?>
	</h1>
	<?php if (!$guest) { ?>
		<h1>Join the Tournament</h1>
	<?php } ?>
	<script>
		window.onload = draw_win;
	</script>
</body>

</html>
