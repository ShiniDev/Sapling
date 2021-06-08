<?php

namespace Sapling\config;

/**
 *  @Author: ShiniDev
 *  @File Created: June 8, 2021
 *  @Last Edited: June 8, 2021
 */
/**
 *  Routes
 * 
 *  This config sets the default controller and function for
 *  undefined values
 */
defined("SAFE") or die("Direct access to scripts are not allowed.");
class Routes
{
    public const DEFAULT_CONTROLLER = 'Test';
    public const DEFAULT_FUNCTION = 'index';
    public const ERROR_PAGE_LOCATION = SYSTEM_PATH . "core" . SEP . "error.php";
}
/**
 *  Get the url parameters and sanitize them to usable code
 */
$sap['controller'] = ucfirst($_REQUEST['controller'] ?? Routes::DEFAULT_CONTROLLER);
$sap['function'] = $_REQUEST['func'] ?? Routes::DEFAULT_FUNCTION;
$sap['function'] = $sap['function'] === "" ? Routes::DEFAULT_FUNCTION : $sap['function'];
if (!isset($sap['parameters']))
{
    $sap['parameters'] = [];
}
else
{
    $sap['parameters'] = explode('/', $_REQUEST['param']); // Sanitize url parameters
    $sap['parameters'] = array_filter($sap['parameters'], 'strlen'); // Filter empty array values
    $sap['parameters'] = array_values($sap['parameters']); // Readjust index value
}
