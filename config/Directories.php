<?php

namespace Sapling\Config;

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
    public const APP_VIEW = APP_PATH . "View" . SEP;
    public const APP_MODEL = APP_PATH . "Model" . SEP;
    public const APP_CONTROLLER = APP_PATH . "Controller" . SEP;
}
