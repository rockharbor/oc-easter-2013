<?php

class Db {

	protected $connection = null;

	public $error = false;

	public function __construct() {
		$db = APP . DS . 'database.sqlite3';
		try {
			$this->connection = new PDO(
				"sqlite:$db",
				null,
				null,
				array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
			);
		} catch (PDOException $e) {
			$this->error = $e->getMessage();
		}
	}

	public function save($data) {
		if (is_null($this->connection)) {
			return false;
		}

		$sql = "INSERT INTO `uploads` (`filename`, `note`, `created`, `approved`) VALUES(:filename, :note, :created, 0);";
		$statement = $this->connection->prepare($sql);
		$statement->bindParam(':filename', $data['filename'], PDO::PARAM_STR);
		$statement->bindParam(':note', $data['note'], PDO::PARAM_STR, 140);
		$statement->bindParam(':created', $data['created']);
		$results = $statement->execute();
		if ($results === false) {
			$error = $statement->errorInfo();
			// $error[2] is the readable message
			$this->error = $error[2];
			return false;
		}
		return true;
	}

	public function find($filename) {
		if (is_null($this->connection)) {
			return false;
		}

		$sql = "SELECT `filename`, `note` FROM `uploads` WHERE `filename` = :filename LIMIT 1";
		$statement = $this->connection->prepare($sql);
		$results = $statement->execute(array(':filename' => $filename));
		if ($results === false) {
			$error = $statement->errorInfo();
			// $error[2] is the readable message
			$this->error = $error[2];
			return false;
		}
		$results = $statement->fetchObject();
		if ($results === false) {
			return array();
		}
		return array($results);
	}

}
