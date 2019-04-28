<?php
require 'Database.php';

session_start();

$username = $_SESSION['username'];
$email = $_SESSION['email'];

$modify = $_POST['modify'];

$db = new Database();

if ($modify === "username")
{
	$new = $_POST[$modify];
	$db->query("UPDATE test_table SET $modify = :$modify WHERE username = '$username'");
	$db->bind(":$modify", $new);
	$db->execute();
}

$db->query("SELECT * FROM test_table WHERE $user_type='$user'");

$rows = $db->resultset();

var_dump($rows);

if (count($rows) !== 1)
{
	throw ("ERROR - The amount of users matching this username/email is not 1 (0 or more than 1");
}
	

?>
