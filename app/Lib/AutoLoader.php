<?php

class AutoLoader {

	protected $prefix = null;

	public function __construct($prefix = null) {
		if ($prefix) {
			$prefix .= DIRECTORY_SEPARATOR;
		}
		$this->prefix = $prefix;

		spl_autoload_register(array($this, 'autoload'));
	}

	public function autoload($className) {
		$className = ltrim($className, '\\');
		$fileName  = '';
		$namespace = '';
		if ($lastNsPos = strrpos($className, '\\')) {
			$namespace = substr($className, 0, $lastNsPos);
			$className = substr($className, $lastNsPos + 1);
			$fileName  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
		}
		$fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';
		require $this->prefix . $fileName;
	}

}