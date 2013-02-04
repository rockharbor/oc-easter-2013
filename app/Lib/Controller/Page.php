<?php

class Page {

	protected $_vars = array();

	public function set($varName, $varValue) {
		if (is_array($varName)) {
			foreach ($varName as $name => $value) {
				$this->_vars[$name] = $value;
			}
		} else {
			$this->_vars[$varName] = $varValue;
		}
	}

	public function render($view = 'Error') {
		if (!isset($this->_vars['title'])) {
			$this->_vars['title'] = $view;
		}
		ob_start();
		extract($this->_vars);
		include LIB . DIRECTORY_SEPARATOR . 'View' . DIRECTORY_SEPARATOR . "$view.php";
		$content = ob_get_clean();
		include LIB . DIRECTORY_SEPARATOR . 'View' . DIRECTORY_SEPARATOR . 'Layout.php';
	}

	public function redirect($path = '/') {
		header("Location: $path");
		exit();
	}

}