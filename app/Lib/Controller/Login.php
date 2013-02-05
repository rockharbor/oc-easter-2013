<?php

class Login extends Page {

	public function __construct() {
		session_start();
	}

	public function GET() {
		$this->render('Login');
	}

	public function POST() {
		$salt = $this->getConfig('salt');
		$password = sha1($salt.$_POST['password']);

		$db = new Db();
		if ($db->login($_POST['username'], $password)) {
			$_SESSION['loggedin'] = true;
			$this->redirect('/admin');
		} else {
			$this->set('error', 'Invalid username or password.');
		}

		$this->render('Login');
	}

}