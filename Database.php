<?php

require("config/database.php");

class Database
{
	private $dsn = 'pgsql';
	private $host = 'space-wars.cnr68zjstbr2.us-west-1.rds.amazonaws.com';
	private $port = '5432';
	private $user = 'jkaplin';
	private $pass = 'o4nsTxUk';
	private $dbname = 'sw';

	private $dbh;
	private $error;
	private $stmt;

	public function __construct()
	{
		$dsn = "$this->dsn:host = $this->host; port = $this->port; dbname = $this->dbname;";
		$options = array(
			PDO::ATTR_PERSISTENT => true,
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
		);
		try
		{
			$this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
		}
		catch(PDOException $e)
		{
			$this->error = $e->getMessage();
			throw ($this->error);
		}
	}

	public function query($query)
	{
		$this->stmt = $this->dbh->prepare($query);
	}

	public function bind($param, $value, $type = null)
	{
		if (is_null($type))
		{
			switch (true)
			{
				case is_int($value):
					$type = PDO::PARAM_INT;
					break;
				case is_bool($value):
					$type = PDO::PARAM_BOOL;
					break;
				case is_null($value):
					$type = PDO::PARAM_NULL;
					break;
				default:
					$type = PDO::PARAM_STR;
			}
		}
		$this->stmt->bindValue($param, $value, $type);
	}

	public function execute()
	{
		return ($this->stmt->execute());
	}

	public function lastInsertId()
	{
		$this->dbh->lastInsertId();
	}

	public function resultset()
	{
		$this->execute();
		return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
	}
}
?>
