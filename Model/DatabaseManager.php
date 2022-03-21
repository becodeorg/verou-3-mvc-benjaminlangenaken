<?php

class DatabaseManager
{
	private string $host;
	private string $user;
	private string $password;
	private string $dbname;
	public PDO $connection;

	public function __construct(string $host, string $user, string $password, string $dbname)
	{
		$this->host = $host;
		$this->user = $user;
		$this->password = $password;
		$this->dbname = $dbname;
	}

	public function connect(): void
	{
		try {
			$dsn = "mysql:host={$this->host}; dbname={$this->dbname}";
			$this->connection = new PDO($dsn, $this->user, $this->password);
			$this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			echo "Database connection succeeded";
		} catch(PDOException $e) {
			echo "Connection failed: ".$e->getMessage().'<br>';
			echo "Error code: ".$e->getCode().'<br>';
			echo "Error occurred in file: ".$e->getFile().'<br>';
			echo "Error occurred on line: ".$e->getLine().'<br>';
		}
	}
}