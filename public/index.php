<?php

require '../vendor/autoload.php';

$routes = [
    "/" => '../app/controllers/homepage.php',
    "/about" => '../app/controllers/about.php',
    "/contacts" => '../app/controllers/contacts.php'
];

//print_r($routes);

$route = $_SERVER['REQUEST_URI'];
if (array_key_exists($route, $routes)) {
	require_once($routes[$route]);
	exit;
} else {
	echo "404";
}