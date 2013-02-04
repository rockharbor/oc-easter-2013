<?php
define('APP', dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'app');
define('LIB', APP . DIRECTORY_SEPARATOR . 'Lib');
define('VENDOR', APP . DIRECTORY_SEPARATOR . 'Vendor');

require VENDOR . DIRECTORY_SEPARATOR . 'Glue' . DIRECTORY_SEPARATOR . 'glue.php';
require LIB . DIRECTORY_SEPARATOR . 'AutoLoader.php';

new AutoLoader(LIB . DIRECTORY_SEPARATOR . 'Controller');

$routes = array(
	'/' => 'Index',
	'/victory/upload' => 'Upload'
);

try {
	glue::stick($routes);
} catch (Exception $e) {
	$error = new Error();
	$error->render();
}