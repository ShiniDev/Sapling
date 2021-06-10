<?php

/**
 *  Get the url parameters and sanitize them to usable code
 */

use Sapling\system\config\Routes;

$sap['controller'] = ucfirst($_REQUEST['controller'] ?? Routes::DEFAULT_CONTROLLER);
$sap['function'] = $_REQUEST['func'] ?? Routes::DEFAULT_FUNCTION;
$sap['function'] = $sap['function'] === "" ? Routes::DEFAULT_FUNCTION : $sap['function'];
if (!isset($sap['parameters'])) {
    $sap['parameters'] = [];
} else {
    // Sanitize url parameters
    $sap['parameters'] = explode('/', $_REQUEST['param']);
    // Filter empty array values
    $sap['parameters'] = array_filter($sap['parameters'], 'strlen');
    // Readjust index value
    $sap['parameters'] = array_values($sap['parameters']);
}
