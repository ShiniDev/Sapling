<?php

namespace Sapling\config;

defined("SAFE") or die("Direct access to scripts are not allowed.");
/**
 *  @Author: ShiniDev
 *  @File Created: June 8, 2021
 *  @Last Edited: June 8, 2021
 */
/**
 *  Directories
 * 
 *  Configure to change default MVC directory structure
 * 
 *  SEP = / for Linux, MacOS
 *  SEP = \\ for Windows
 */
class Directories
{
    public const APP_VIEW = APP_PATH . "view" . SEP;
    public const APP_MODEL = APP_PATH . "model" . SEP;
    public const APP_CONTROLLER = APP_PATH . "controller" . SEP;
}
