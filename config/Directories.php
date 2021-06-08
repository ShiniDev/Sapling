<?php

namespace Sapling\config;

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
    public const APP_VIEW = "app" . SEP . "view" . SEP;
    public const APP_MODEL = "app" . SEP . "model" . SEP;
    public const APP_CONTROLLER = "app" . SEP . "controller" . SEP;
}
