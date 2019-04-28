<?php

require("database.php");

$dsn = "pgsql";
$host = "space-wars.cnr68zjstbr2.us-west-1.rds.amazonaws.com";
$port = "5432";
$user = "jkaplin";
$pass = "o4nsTxUk";
$dbname = "sw";

$db_info = "$dsn:host=$host; port=$port; dbname=$dbname;";
$options = array(
	PDO::ATTR_PERSISTENT => true,
	PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
);
$dbh = new PDO($db_info, $user, $pass, $options);

$query = ("CREATE TABLE users (
	id SERIAL,
	type varchar(50) DEFAULT NULL,
	email VARCHAR(100) UNIQUE NOT NULL,
	username VARCHAR(100) UNIQUE NOT NULL,
	password VARCHAR(100) NOT NULL,
	creation_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	level INT DEFAULT 0,
	PRIMARY KEY (id));"
);

$stmt = $dbh->prepare($query)->execute();

?>
