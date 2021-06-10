<?php
// Load the controller

use Sapling\system\config\Directories;
use Sapling\system\config\Routes;

if (file_exists(Directories::APP_CONTROLLER . $sap['controller'] . ".php")) {
    require_once Directories::APP_CONTROLLER . $sap['controller'] . ".php";
    // Dynamically load controller class
    $sap['controller'] = "Sapling\\app\\controller\\" . $sap['controller'];
    $sap['controller'] = new $sap['controller'];

    if (method_exists($sap['controller'], (string)$sap['function'])) {
        $sap['controller']->{$sap['function']}($sap['parameters']);
    } else {
        require_once Routes::ERROR_PAGE_LOCATION;
    }
} else if ($sap['controller'] === "") {
    require_once Directories::APP_CONTROLLER . Routes::DEFAULT_CONTROLLER . ".php";
    // Dynamically load controller class
    $sap['controller'] = "Sapling\\app\\controller\\" . Routes::DEFAULT_CONTROLLER;
    $sap['controller'] = new $sap['controller'];

    if (method_exists($sap['controller'], (string)$sap['function'])) {
        $sap['controller']->{$sap['function']}($sap['parameters']);
    } else {
        require_once Routes::ERROR_PAGE_LOCATION;
    }
} else {
    require_once Routes::ERROR_PAGE_LOCATION;
}
