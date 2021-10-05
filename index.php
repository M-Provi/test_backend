<?php

session_start();
//Autoload all controllers
require_once 'config/autoload.php';

//Load constants and header
require_once 'config/parameters.php';
require_once 'views/layout/header.php';


//Check if controller exists, else load default
if (isset($_GET['controller'])) {
	$controller_name = $_GET['controller'] . 'Controller';
} elseif (!isset($_GET['controller']) && !isset($_GET['action'])) {
	$controller_name = controller_default;
} else {
	exit();
}

// Check if controller exists
if (class_exists($controller_name)) {
	$controller = new $controller_name();

    //Check action, else load index of controller
	if (isset($_GET['action']) && method_exists($controller, $_GET['action'])) {
		$action = $_GET['action'];
		$controller->$action();
	} elseif (!isset($_GET['controller']) && !isset($_GET['action'])) {
		$action_default = action_default;
		$controller->$action_default();
	}
}

//Load footer
require_once 'views/layout/footer.php';
?>