<?php
error_reporting(E_ALL);
ini_set('display_errors','On');
date_default_timezone_set('America/New_York');
define('DS',"/");
define('ROOT', $_SERVER['DOCUMENT_ROOT'].DS.'adminv3'.DS);

function __autoload($className) {
	$file = $className . '.php';
	
	if (file_exists(ROOT.'classes'.DS.$file)) 
		require_once ROOT.'classes'.DS.$file;
	else if(file_exists(ROOT.'model'.DS. strtolower($file))) 
		require_once ROOT.'model'.DS. strtolower($file);
	else
		throw new Exception('The class ' . $className . ' could not be loaded');
}

require_once ROOT.'config.php';


?>