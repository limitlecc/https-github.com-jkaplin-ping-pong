<?php
	session_start();
	if (isset($_SESSION["user"]))
	{
		$user = $_SESSION['user'];
		$intra = $user->login;
		$name = $user->displayname;
		$img = $user->image_url;
	}
	else
	{
		$intra = "GUEST";
		$name = "GUEST";
		$img = "guest.jpg";
	}
?>
<body>
	<h1>
		<?php
			echo $intra;
			echo PHP_EOL;
			echo $name;
			echo PHP_EOL;
			echo $img;
		?>
	</h1>
</body>
