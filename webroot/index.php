<?php
define('DEBUG', false);
define('DS', DIRECTORY_SEPARATOR);
define('APP', dirname(dirname(__FILE__)) . DS . 'app');
define('WEBROOT', dirname(dirname(__FILE__)) . DS . 'webroot');
define('LIB', APP . DS . 'Lib');
define('VENDOR', APP . DS . 'Vendor');

require VENDOR . DS . 'Glue' . DS . 'glue.php';
require LIB . DS . 'Db.php';
require LIB . DS . 'AutoLoader.php';

new AutoLoader(LIB . DS . 'Controller');

$routes = array(
	'/victory/upload' => 'Upload',
	'/victory/process/([a-zA-Z0-9]+\.png)' => 'Process',
	'/victory/view/?([a-zA-Z0-9]+\.png)?\??(.+)?' => 'Victory',
	'/victory/choose' => 'Choose',
	'/image/([a-zA-Z0-9]+\.png)' => 'Image',
	'/admin/approve/([a-zA-Z0-9]+\.png)?' => 'Admin',
	'/pages/?([a-zA-Z0-9-]+)\??(.+)?' => 'Page',
	'/admin/?(\d)?' => 'Admin',
	'/login' => 'Login',
	'/(.+)?' => 'Index'
);

try {
	glue::stick($routes);
} catch (Exception $e) {
	$error = new Error();
	$error->render();
}