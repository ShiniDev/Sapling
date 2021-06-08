<?php

use Sapling\config\Directories;

define("SEP", DIRECTORY_SEPARATOR);

// Require system libs
require_once "config" . SEP . "Directories.php";
require_once "config" . SEP . "Database.php";
require_once "system" . SEP . "model" . SEP . "Model.php";
require_once "system" . SEP . "controller" . SEP . "Controller.php";

// Sanitize url input
$sap['controller'] = ucfirst($_REQUEST['controller']);
$sap['function'] = $_REQUEST['func'] === "" ? "index" : $_REQUEST['func'];
$sap['parameters'] = explode('/', $_REQUEST['param']);
$sap['parameters'] = array_filter($sap['parameters'], 'strlen');
$sap['parameters'] = array_values($sap['parameters']);

// Load controller
require_once Directories::APP_CONTROLLER . $sap['controller'] . ".php";
$sap['controller'] = new $sap['controller'];
// Call function
$sap['controller']->{$sap['function']}($sap['parameters']);
