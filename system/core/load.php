<?php

use Sapling\config\Directories;
use Sapling\config\Routes;

/**
 *  @Author: ShiniDev
 *  @File Created: June 8, 2021
 *  @Last Edited: June 8, 2021
 */

/**
 *  This file loads the controller and function and gets the data from the url.
 */

/**
 *  Get the url parameters and sanitize them to usable code
 */
$sap['controller'] = ucfirst($_REQUEST['controller'] ?? Routes::DEFAULT_CONTROLLER);
$sap['function'] = $_REQUEST['func'] ?? Routes::DEFAULT_FUNCTION;
$sap['function'] = $sap['function'] === "" ? Routes::DEFAULT_FUNCTION : $sap['function'];
if (!isset($sap['parameters'])) {
    $sap['parameters'] = [];
} else {
    $sap['parameters'] = explode('/', $_REQUEST['param']); // Sanitize url parameters
    $sap['parameters'] = array_filter($sap['parameters'], 'strlen'); // Filter empty array values
    $sap['parameters'] = array_values($sap['parameters']); // Readjust index value
}

// Load the controller
if (file_exists(Directories::APP_CONTROLLER . $sap['controller'] . ".php")) {
    require_once Directories::APP_CONTROLLER . $sap['controller'] . ".php";
    $sap['controller'] = new $sap['controller'];
    if (method_exists($sap['controller'], (string)$sap['function'])) {
        $sap['controller']->{$sap['function']}($sap['parameters']);
    } else {
        require_once Routes::ERROR_PAGE_LOCATION;
    }
} else if ($sap['controller'] === "") {
    require_once Directories::APP_CONTROLLER . Routes::DEFAULT_CONTROLLER . ".php";
    $sap['controller'] = Routes::DEFAULT_CONTROLLER;
    $sap['controller'] = new $sap['controller'];
    if (method_exists($sap['controller'], (string)$sap['function'])) {
        $sap['controller']->{$sap['function']}($sap['parameters']);
    } else {
        require_once Routes::ERROR_PAGE_LOCATION;
    }
} else {
    require_once Routes::ERROR_PAGE_LOCATION;
}
