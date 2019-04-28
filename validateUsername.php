<?php

require("Database.php");

$username = $_POST['username'];

if (!$username)
{
	$used = null;
}
else
{
	$db = new Database();

	$db->query("SELECT username FROM users WHERE username='$username'");

	$rows = $db->resultset();

	if (count($rows) !== 0)
	{
		$used = true;
	}
	else
	{
		$used = false;
	}
}

echo json_encode($used, JSON_PRETTY_PRINT);

?>
