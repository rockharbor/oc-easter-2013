<?php

class Page {

	protected $_vars = array();

	public function requireLogin() {
		session_start();
		if (isset($_SESSION['loggedin'])) {
			return true;
		}
		$this->redirect('/login');
	}

	public function getConfig($value = null) {
		$config = file_get_contents(APP . DS . 'Config' . DS . 'config.json');
		$config = json_decode($config);
		if ($value) {
			$config = $config->{$value};
		}
		return $config;
	}

	public function set($varName, $varValue = null) {
		if (is_array($varName)) {
			foreach ($varName as $name => $value) {
				$this->_vars[$name] = $value;
			}
		} else {
			$this->_vars[$varName] = $varValue;
		}
	}

	public function render($view = 'Error') {
		$layout = 'Layout';
		if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			$layout = 'Ajax';
		}

		if (!isset($this->_vars['title'])) {
			$this->_vars['title'] = $view;
		}
		ob_start();
		extract($this->_vars);
		include LIB . DIRECTORY_SEPARATOR . 'View' . DIRECTORY_SEPARATOR . "$view.php";
		$content = ob_get_clean();
		include LIB . DIRECTORY_SEPARATOR . 'View' . DIRECTORY_SEPARATOR . "$layout.php";
	}

	public function redirect($path = '/') {
		header("Location: $path");
		exit();
	}

}