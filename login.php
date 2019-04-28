<?php
require 'Database.php';

session_start();

if (!isset($_POST['user']) or !isset($_POST['password']))
{
	throw ("ERROR no user or password provided while logging in");
}
else
{
	$user = $_POST['user'];
	$pass = $_POST['pass'];
}

if (filter_var($user, FILTER_VALIDATE_EMAIL))
{
	$user_type = 'email';
}
else
{
	$user_type = 'username';
}

$db = new Database();

$db->query("SELECT * FROM users WHERE $user_type='$user'");

$rows = $db->resultset();

var_dump($rows);

if (count($rows) !== 1)
{
	throw ("ERROR - The amount of users matching this username/email is not 1 (0 or more than 1");
}
	

?>
