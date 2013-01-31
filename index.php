<?php

require 'Vendor' . DIRECTORY_SEPARATOR . 'Glue' . DIRECTORY_SEPARATOR . 'glue.php';
require 'Lib' . DIRECTORY_SEPARATOR . 'AutoLoader.php';

new AutoLoader('Lib' . DIRECTORY_SEPARATOR . 'Controller');

define('LIB', dirname(__FILE) . DIRECTORY_SEPARATOR . 'Lib');

$routes = array(
	'/' => 'Index'
);

try {
	glue::stick($routes);
} catch (Exception $e) {
	$error = new Error();
	$error->render();
}