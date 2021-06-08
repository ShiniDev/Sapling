<?php

use Sapling\config\Directories;
use Sapling\config\Routes;

/**
 *  @Author: ShiniDev
 *  @File Created: June 8, 2021
 *  @Last Edited: June 8, 2021
 */
/**
 *  This file loads the controller and function
 */
// Load the controller
if (file_exists(Directories::APP_CONTROLLER . $sap['controller'] . ".php"))
{
    require_once Directories::APP_CONTROLLER . $sap['controller'] . ".php";
    $sap['controller'] = new $sap['controller'];
    if (method_exists($sap['controller'], (string)$sap['function']))
    {
        $sap['controller']->{$sap['function']}($sap['parameters']);
    }
    else
    {
        require_once Routes::ERROR_PAGE_LOCATION;
    }
}
else if ($sap['controller'] === "")
{
    require_once Directories::APP_CONTROLLER . Routes::DEFAULT_CONTROLLER . ".php";
    $sap['controller'] = Routes::DEFAULT_CONTROLLER;
    $sap['controller'] = new $sap['controller'];
    if (method_exists($sap['controller'], (string)$sap['function']))
    {
        $sap['controller']->{$sap['function']}($sap['parameters']);
    }
    else
    {
        require_once Routes::ERROR_PAGE_LOCATION;
    }
}
else
{
    require_once Routes::ERROR_PAGE_LOCATION;
}
