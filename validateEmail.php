<?php

require("Database.php");

$email = $_POST['email'];

if (!$email)
{
	$used = null;
}
else
{
	$db = new Database();

	$db->query("SELECT email FROM users WHERE email='$email'");

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
