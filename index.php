<?php
require_once 'views/View.php';
require_once 'Bootstrap.php';

Bootstrap::load('views');
Bootstrap::load('io/');

Configuration::loadByFile('config/database.ini');
Configuration::loadByFile('config/application.ini');

$uri = $_SERVER['REQUEST_URI'];

$viewName = DEFAULT_VIEW;

if ($uri !== '/') {
	$params = explode('/', $uri);
	$viewName = ucfirst($params[1]);
}

if (class_exists($viewName . 'View')) {
	$viewName = $viewName . 'View';
} else {
	http_response_code(404);
	exit;
}

if ($viewName == DEFAULT_VIEW . 'View' && $uri === '/') {
	header('Location: /home');
}

$view = new $viewName;
$view->init();

echo $view->getOutput();