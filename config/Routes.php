<?php

namespace Sapling\Config;

/**
 *  Routes
 * 
 *  This config sets the default controller and function for
 *  undefined values
 */

class Routes
{
    public const BASE_URL = '';
    public const DEFAULT_CONTROLLER = 'Test';
    public const DEFAULT_FUNCTION = 'index';
    public const DEFAULT_ERROR_PAGE = Directories::APP_VIEW . "error" . SEP . "default_error.php";
    public const CUSTOM_ERROR_PAGE_LOCATION = self::DEFAULT_ERROR_PAGE;
}
