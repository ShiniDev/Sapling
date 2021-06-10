<?php

namespace Sapling\system\config;

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
class Routes
{
    public const DEFAULT_CONTROLLER = 'Test';
    public const DEFAULT_FUNCTION = 'index';
    public const ERROR_PAGE_LOCATION = SYSTEM_PATH . "core" . SEP . "errors" . SEP . "default_error.php";
    public const CUSTOM_ERROR_LOCATION = SYSTEM_PATH . "core" . SEP . "errors" . SEP;
    public const DEFAULT_CUSTOM_ERROR_LOCATION = SYSTEM_PATH . "core" . SEP . "errors" . SEP;
}
