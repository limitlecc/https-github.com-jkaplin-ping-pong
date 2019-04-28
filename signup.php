<?php

require 'Database.php';

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

$db = new Database();

$db->query("INSERT INTO users (username, email, password) VALUES('$username', '$email', '$password')");
$db->execute();

?>
