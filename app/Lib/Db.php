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

	public function login($username, $password) {
		$sql = "SELECT COUNT(*) FROM `users` where `username` = :username AND `password` = :password LIMIT 1;";
		$statement = $this->connection->prepare($sql);
		$statement->bindParam(':username', $username, PDO::PARAM_STR);
		$statement->bindParam(':password', $password, PDO::PARAM_STR);
		$results = $statement->execute();
		if ($results === false) {
			$error = $statement->errorInfo();
			// $error[2] is the readable message
			$this->error = $error[2];
			return false;
		}
		return $statement->fetchColumn() > 0;
	}

	public function approve($filename) {
		$sql = "UPDATE `uploads` SET `approved` = 1 WHERE `filename` = :filename";
		$statement = $this->connection->prepare($sql);
		$results = $statement->execute(array(':filename' => $filename));
		if ($results === false) {
			$error = $statement->errorInfo();
			// $error[2] is the readable message
			$this->error = $error[2];
			return false;
		}
		return $statement->rowCount() > 0;
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

	public function findCount() {
		$sql = "SELECT COUNT(*) FROM `uploads`;";
		$count = $this->connection->query($sql)->fetchColumn();
		if ($count === false) {
			$error = $statement->errorInfo();
			// $error[2] is the readable message
			$this->error = $error[2];
			return false;
		}
		return $count;
	}

	public function findAll($page = false) {
		$limit = 20;
		if ($page === false) {
			$page = 1;
		}
		$offset = ($page-1) * $limit;
		$sql = "SELECT * FROM `uploads` LIMIT $offset, $limit;";
		$statement = $this->connection->prepare($sql);
		$results = $statement->execute();
		if ($results === false) {
			$error = $statement->errorInfo();
			// $error[2] is the readable message
			$this->error = $error[2];
			return false;
		}
		$results = $statement->fetchAll(PDO::FETCH_CLASS);
		if ($results === false) {
			return array();
		}
		return $results;
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
